<?php

namespace App\Http\Controllers\Mentee;

use App\Http\Controllers\Controller;
use App\MentorSession;
use App\RescheduleRequest;
use Illuminate\Support\Facades\Auth;
use App\Mapping;
use Google\Client as GoogleClient;
use Google\Service\Calendar as GoogleCalendar;
use Google\Service\Calendar\Event;
use Google\Service\Calendar\EventDateTime;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookSlotController extends Controller
{
 

   public function showAvailableSlots()
    {
        $mentee = Auth::user()->mentee;

        if (!$mentee) {
            return back()->with('error', 'You are not registered as a mentee.');
        }

        $mapping = Mapping::where('menteename_id', $mentee->id)->first();

        if (!$mapping) {
            return back()->with('error', 'No mentor mapped to you.');
        }

        $mappedMentorId = $mapping->mentorname_id;

        // Available slots
        $slots = MentorSession::where('mentor_id', $mappedMentorId)
                    ->where('status', 'available')
                    ->orderBy('slot_time', 'asc')
                    ->get();

        // Booked slots for this mentee
        $bookedSlots = MentorSession::where('mentee_id', $mentee->id)
                    ->where('status', 'booked')  // Important: Only booked slots
                    ->orderBy('slot_time', 'desc')
                    ->get();


        return view('mentee.session.bookslot', compact('slots', 'bookedSlots'));
    }

    public function bookSlot($slotId)
    {
        $mentee = Auth::user()->mentee;

        if (!$mentee) {
            return back()->with('error', 'You are not registered as a mentee.');
        }

        $slot = MentorSession::where('id', $slotId)->where('status', 'available')->first();

        if (!$slot) {
            return back()->with('error', 'Slot is not available.');
        }

        $mentor = $slot->mentor;

        if (!$mentor || !$mentor->google_access_token) {
            return back()->with('error', 'Mentor has not connected Google Calendar.');
        }

        // Initialize Google Client
        $client = new GoogleClient();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setAccessToken([
            'access_token'  => $mentor->google_access_token,
            'refresh_token' => $mentor->google_refresh_token,
        ]);

        if ($client->isAccessTokenExpired()) {
            $newToken = $client->fetchAccessTokenWithRefreshToken($mentor->google_refresh_token);
            $mentor->google_access_token = $newToken['access_token'];
            $mentor->google_token_expires = now()->addSeconds($newToken['expires_in']);
            $mentor->save();
            $client->setAccessToken($newToken);
        }

        $calendarService = new GoogleCalendar($client);

        // Create the Calendar Event
        $event = new Event([
            'summary' => 'Mentorship Session',
            'description' => $slot->description,
            'start' => new EventDateTime([
                'dateTime' => Carbon::parse($slot->slot_time)->toRfc3339String(),
                'timeZone' => 'Asia/Kolkata',
            ]),
            'end' => new EventDateTime([
                'dateTime' => Carbon::parse($slot->slot_time)->addHour()->toRfc3339String(),
                'timeZone' => 'Asia/Kolkata',
            ]),
            'attendees' => [
                ['email' => $mentee->user->email],
                ['email' => $mentor->user->email],
            ],
        ]);

        // Important: request Google to send invitations
        $createdEvent = $calendarService->events->insert('primary', $event, [
            'sendUpdates' => 'all'
        ]);

        // Update the slot in DB
        $slot->update([
            'mentee_id'     => $mentee->id,
            'status'        => 'booked',
            'calendar_link' => $createdEvent->htmlLink,
        ]);

        return back()->with('success', 'Slot booked and calendar event created successfully.');
    }

    public function sendRescheduleRequest(Request $request, $slotId)
    {
        $request->validate([
            'reason' => 'required|string|max:1000',
        ]);

        $slot = MentorSession::findOrFail($slotId);

        RescheduleRequest::create([
            'mentee_id' => Auth::user()->mentee->id,
            'mentor_id' => $slot->mentor_id,
            'mentor_session_id' => $slot->id,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Reschedule request sent to your mentor.');
    }


}
