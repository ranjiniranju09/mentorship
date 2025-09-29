<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\MentorSession;
use App\RescheduleRequest;
use App\Module;
use Carbon\Carbon;

class MentorSlotController extends Controller
{
  public function index()
{
    $mentorId = auth()->user()->mentor->id;

    $slots = MentorSession::where('mentor_id', $mentorId)
                ->where('status', 'available')
                ->with('module')
                ->get();

    $bookedSlots = MentorSession::where('mentor_id', $mentorId)
                    ->where('status', 'booked')
                    ->with('module')
                    ->get();

    // Fetch reschedule requests with session and module info
    $rescheduleRequests = RescheduleRequest::with(['session.module', 'mentee'])
                        ->where('mentor_id', $mentorId)
                        ->where('status', 'pending')
                        ->get();

    $modules = Module::all();

    return view('mentor.sessions.appointments', compact('slots', 'bookedSlots', 'rescheduleRequests','modules'));
}



    public function store(Request $request)
    {
        $mentor = Auth::user()->mentor;

        // Validate input fields
        $request->validate([
            'module_id'    => 'required|exists:modules,id',
            'descriptions' => 'required|string|min:10|max:1000',
            'slot_time'    => 'required|array',
            'slot_time.*'  => 'required|date',
        ]);

        // Ensure the selected module exists in the database
        $moduleExists = Module::where('id', $request->module_id)->exists();
        if (!$moduleExists) {
            return back()->with('error', 'Selected module does not exist.');
        }

        $createdCount = 0;

        foreach ($request->slot_time as $slotTime) {
            $parsedSlotTime = Carbon::parse($slotTime)->timezone('Asia/Kolkata');

            // 1️⃣ Condition: Slot time must be in the future
            if ($parsedSlotTime->isPast()) {
                return back()->with('error', 'Slot time must be in the future.');
            }

            // 2️⃣ Condition: Prevent creating a duplicate slot at the exact same time
            $exists = MentorSession::where('mentor_id', $mentor->id)
                        ->where('slot_time', $parsedSlotTime->toDateTimeString())
                        ->exists();

            if ($exists) {
                return back()->with('error', "You already have a slot at {$parsedSlotTime->format('Y-m-d H:i')}.");
            }

            // 3️⃣ Condition: Enforce a minimum 15-minute gap between slots
            $conflict = MentorSession::where('mentor_id', $mentor->id)
                ->whereBetween('slot_time', [
                    $parsedSlotTime->copy()->subMinutes(15),
                    $parsedSlotTime->copy()->addMinutes(15)
                ])
                ->exists();

            if ($conflict) {
                return back()->with('error', "Please allow at least 15 minutes gap between slots. Conflict at {$parsedSlotTime->format('Y-m-d H:i')}.");
            }

            // 4️⃣ Condition: Limit max 5 slots per day per mentor
            $slotsCount = MentorSession::where('mentor_id', $mentor->id)
                ->whereDate('slot_time', $parsedSlotTime->toDateString())
                ->count();

            if ($slotsCount >= 5) {
                return back()->with('error', "You have reached the maximum of 05 slots for {$parsedSlotTime->toDateString()}.");
            }

            // ✅ Save valid slot to the database
            MentorSession::create([
                'mentor_id'     => $mentor->id,
                'mentee_id'     => null,
                'module_id'     => $request->module_id,
                'calendar_link' => 0,
                'slot_time'     => $parsedSlotTime->toDateTimeString(),
                'status'        => 'available',
                'descriptions'  => $request->descriptions,
            ]);

            $createdCount++;
        }

        return redirect()->back()->with('success', "$createdCount slot(s) created successfully.");
    }

    public function update(Request $request, $id)
    {
        $slot = MentorSession::findOrFail($id);

        // Prevent editing if already booked
        if ($slot->status !== 'available') {
            return redirect()->back()->with('error', 'Cannot edit slot once it is booked.');
        }

        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'descriptions' => 'required|string|max:1000',
            'slot_time' => 'required|date',
        ]);

        $slot->update([
            'module_id' => $request->module_id,
            'descriptions' => $request->descriptions,
            'slot_time' => Carbon::parse($request->slot_time)->timezone('Asia/Kolkata')->toDateTimeString(),
        ]);

        return redirect()->back()->with('success', 'Slot updated successfully.');
    }
    public function approve(RescheduleRequest $request)
    {
        // Create a new session if new_session_id exists
        if ($request->new_session_id) {
            $newSession = MentorSession::find($request->new_session_id);
            if ($newSession) {
                $newSession->mentee_id = $request->mentee_id;
                $newSession->status = 'booked';
                $newSession->save();

                // Optionally update old session
                $oldSession = MentorSession::find($request->mentor_session_id);
                if ($oldSession) {
                    $oldSession->mentee_id = null;
                    $oldSession->status = 'available';
                    $oldSession->save();
                }

                $request->status = 'approved';
                $request->save();
            }
        }

        return back()->with('success', 'Reschedule request approved.');
    }

    public function reject(RescheduleRequest $request)
    {
        $request->status = 'rejected';
        $request->save();

        return back()->with('error', 'Reschedule request rejected.');
    }

    public function createRescheduledSession(Request $request, $rescheduleId)
    {
        $request->validate([
            'new_slot_time' => 'required|date',
            'descriptions' => 'required|string|max:1000',
        ]);

        $rescheduleRequest = RescheduleRequest::findOrFail($rescheduleId);

        // Create new MentorSession
        $newSession = MentorSession::create([
            'mentor_id' => $rescheduleRequest->mentor_id,
            'mentee_id' => $rescheduleRequest->mentee_id,
            'module_id' => $rescheduleRequest->session->module_id,
            'calender_link' => 0,
            'descriptions' => $request->descriptions,
            'slot_time' => $request->new_slot_time,
            'status' => 'available',
            'reschedule_request_id' => $rescheduleRequest->id, // optional, if you add this column
        ]);

        // Update RescheduleRequest
        $rescheduleRequest->update([
            'new_session_id' => $newSession->id,
            'status' => 'accepted',
        ]);

        return back()->with('success', 'Rescheduled session created successfully.');
    }




}
