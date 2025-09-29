<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Session;
use Google\Client as GoogleClient;
use Illuminate\Support\Facades\DB;
use App\MentorSession;   
use Google_Service_Calendar;
use Carbon\Carbon;

class GoogleCalendarController extends Controller
{
    /**
     * Redirect Mentor to Google OAuth to connect Calendar
     */
   
    public function connect()
    {
        $client = new GoogleClient();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect'));
        $client->addScope(\Google\Service\Calendar::CALENDAR);
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        $authUrl = $client->createAuthUrl();

        return redirect($authUrl);
    }


   public function callback(Request $request)
{
    $client = new \Google\Client();
    $client->setClientId(config('services.google.client_id'));
    $client->setClientSecret(config('services.google.client_secret'));
    $client->setRedirectUri(config('services.google.redirect'));
    $client->addScope(\Google\Service\Calendar::CALENDAR);
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');

    $accessToken = $client->fetchAccessTokenWithAuthCode($request->code);

    if (isset($accessToken['error'])) {
        return redirect()->route('mentor.appointments')
                         ->with('error', 'Google OAuth Error: ' . $accessToken['error_description']);
    }

    $mentor = \App\Mentor::where('user_id', Auth::id())->first();

    if (!$mentor) {
        return redirect()->route('mentor.appointments')
                         ->with('error', 'Mentor profile not found.');
    }

    $mentor->google_access_token  = $accessToken['access_token'];
    $mentor->google_refresh_token = $accessToken['refresh_token'];
    $mentor->google_token_expires = now()->addSeconds(86400);  // 24-hour expiry
    $mentor->save();

    return redirect('https://calendar.google.com');
}





    public function appointments()
    {
        $mentorId = Auth::id();

        $sessions = MentorSession::with('mentee', 'module') // eager load relationships
                        ->where('mentor_id', $mentorId)
                        ->orderBy('slot_time', 'asc')
                        ->get();

        return view('mentor.sessions.appointments', compact('sessions'));
    }



//     public function storeAppointment(Request $request)
// {
//     $mentor = Auth::user()->mentor;

//     $client = new GoogleClient();
//     $client->setClientId(config('services.google.client_id'));
//     $client->setClientSecret(config('services.google.client_secret'));
//     $client->setRedirectUri(config('services.google.redirect'));
//     $client->setAccessToken([
//         'access_token'  => $mentor->google_access_token,
//         'refresh_token' => $mentor->google_refresh_token,
//     ]);

//     if ($client->isAccessTokenExpired()) {
//         $newToken = $client->fetchAccessTokenWithRefreshToken($mentor->google_refresh_token);
//         $mentor->google_access_token  = $newToken['access_token'];
//         $mentor->google_token_expires = now()->addSeconds(86400);  // 24-hour expiry
//         $mentor->save();
//         $client->setAccessToken($newToken);
//     }

//     $service = new \Google\Service\Calendar($client);

//     $istSlotTime = Carbon::parse($request->slot_time)->timezone('Asia/Kolkata')->format('Y-m-d\TH:i:s');

//     $event = new \Google\Service\Calendar\Event([
//         'summary'     => 'Mentorship Slot',
//         'description' => 'Available slot for mentorship',
//         'start' => [
//             'dateTime' => $istSlotTime,
//             'timeZone' => 'Asia/Kolkata'
//         ],
//         'end' => [
//             'dateTime' => Carbon::parse($istSlotTime)->addHour()->format('Y-m-d\TH:i:s'),
//             'timeZone' => 'Asia/Kolkata'
//         ],
//         'conferenceData' => [
//             'createRequest' => [
//                 'requestId' => uniqid(),
//                 'conferenceSolutionKey' => ['type' => 'hangoutsMeet']
//             ],
//         ],
//     ]);

//     $event = $service->events->insert('primary', $event, ['conferenceDataVersion' => 1]);

//     DB::table('mentor_sessions')->insert([
//         'mentor_id'     => $mentor->id,
//         'mentee_id'     => null,
//         'module_id'     => $request->module_id,
//         'calendar_link' => $event->hangoutLink,
//         'slot_time'    => $istSlotTime,
//         'status'      => 'available',
//         'created_at'  => now(),
//         'updated_at'  => now(),
//     ]);

//     return redirect()->route('mentor.appointments')->with('success', 'Appointment slot created.');
// }

    public function syncCalendar()
{
    $mentor = Auth::user()->mentor;

    if (!$mentor || !$mentor->google_access_token) {
        return back()->with('error', 'Google Calendar is not connected.');
    }

    $client = new \Google\Client();
    $client->setClientId(config('services.google.client_id'));
    $client->setClientSecret(config('services.google.client_secret'));
    $client->setAccessToken([
        'access_token'  => $mentor->google_access_token,
        'refresh_token' => $mentor->google_refresh_token,
        'expires_in'    => 3600,
        'created'       => time(),
    ]);

    if ($client->isAccessTokenExpired()) {
        $newToken = $client->fetchAccessTokenWithRefreshToken($mentor->google_refresh_token);
        $mentor->google_access_token = $newToken['access_token'];
        $mentor->google_token_expires = now()->addSeconds($newToken['expires_in']);
        $mentor->save();
        $client->setAccessToken($newToken);
    }

    $service = new \Google\Service\Calendar($client);

    $events = $service->events->listEvents('primary', [
        'timeMin' => now()->toRfc3339String(),
        'timeMax' => now()->addDays(30)->toRfc3339String(),
        'singleEvents' => true,
        'orderBy' => 'startTime',
    ]);

    $count = 0;

    foreach ($events->getItems() as $event) {
        $summary     = strtolower($event->getSummary() ?? '');
        $description = strtolower($event->getDescription() ?? '');

        if (str_contains($summary, '#mentorship-slot') || str_contains($description, '#mentorship-slot')) {
            $slotTime = $event->getStart()->dateTime ?? $event->getStart()->date;

            MentorSession::updateOrCreate(
                ['calendar_link' => $event->getHtmlLink()],
                [
                    'mentor_id'     => $mentor->id,
                    'mentee_id'     => null,
                    'module_id'     => null,
                    'slot_time'    => Carbon::parse($slotTime)->timezone('Asia/Kolkata')->toDateTimeString(),
                    'status'       => 'available',
                    'updated_at'  => now(),
                ]
            );

            $count++;
        }
    }

    return back()->with('success', "$count mentorship slots synced from Google Calendar.");
}

    
}
