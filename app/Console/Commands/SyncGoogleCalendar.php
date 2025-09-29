<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mentor;
use App\MentorSession;
use Google\Client as GoogleClient;
use Google\Service\Calendar as GoogleCalendar;
use Carbon\Carbon;

class SyncGoogleCalendar extends Command
{
    protected $signature = 'google:sync-calendar {user_id?}';
    protected $description = 'Fetch Google Calendar events and store open slots in mentor_sessions table';


    // using the controller sync method instead of this one .
    // public function handle() 
    // {
    //     $userId = $this->argument('user_id');

    //     $mentor = Mentor::where('user_id', $userId)
    //                     ->whereNotNull('google_access_token')
    //                     ->first();

    //     if (!$mentor) {
    //         $this->error('Mentor not found or Google Calendar not connected.');
    //         return;
    //     }

    //     $client = new GoogleClient();
    //     $client->setClientId(config('services.google.client_id'));
    //     $client->setClientSecret(config('services.google.client_secret'));
    //     $client->setAccessToken([
    //         'access_token'  => $mentor->google_access_token,
    //         'refresh_token' => $mentor->google_refresh_token,
    //         'expires_in'    => 3600,
    //         'created'       => time(),
    //     ]);

    //     // Refresh token if expired
    //     if ($client->isAccessTokenExpired()) {
    //         $newToken = $client->fetchAccessTokenWithRefreshToken($mentor->google_refresh_token);
    //         $mentor->google_access_token = $newToken['access_token'];
    //         $mentor->google_token_expires = now()->addSeconds($newToken['expires_in']);
    //         $mentor->save();
    //         $client->setAccessToken($newToken);
    //     }

    //     $service = new GoogleCalendar($client);

    //     $events = $service->events->listEvents('primary', [
    //         'timeMin'      => now()->subDays(1)->toRfc3339String(),
    //         'timeMax'      => now()->addDays(30)->toRfc3339String(),
    //         'singleEvents' => true,
    //         'orderBy'     => 'startTime',
    //     ]);

    //     foreach ($events->getItems() as $event) {
    //         // Log event for debugging
    //         \Log::info('Google Event Fetched', [
    //             'summary'       => $event->getSummary(),
    //             'htmlLink'     => $event->getHtmlLink(),
    //             'startDateTime'=> $event->start->dateTime ?? $event->start->date,
    //         ]);

    //         if (str_contains(strtolower($event->getSummary()), 'mentorship')) {
    //             MentorSession::updateOrCreate(
    //                 ['calendar_link' => $event->getHtmlLink()],
    //                 [
    //                     'mentor_id'     => $mentor->id,
    //                     'mentee_id'     => null,
    //                     'module_id'     => null,
    //                     'slot_time'    => Carbon::parse($event->start->dateTime ?? $event->start->date)
    //                                                ->timezone('Asia/Kolkata')
    //                                                ->toDateTimeString(),
    //                     'status'       => 'available',
    //                     'updated_at'   => now(),
    //                 ]
    //             );
    //         }
    //     }

    //     $this->info('Google Calendar events synced successfully for mentor ID ' . $mentor->id);
    // }

    public function handle()
{
    $userId = $this->argument('user_id');

    $mentor = Mentor::where('user_id', $userId)->whereNotNull('google_access_token')->first();

    if (!$mentor) {
        $this->error('Mentor not found or Google not connected.');
        return;
    }

    // Option 1: Reuse sync logic by calling the same service method (preferred for DRY)
    $controller = new \App\Http\Controllers\Mentor\GoogleCalendarController();
    $response = $controller->syncCalendar();

    $this->info('Manual sync triggered successfully.');
}

}
