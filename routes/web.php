<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ModuleController;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Broadcast::routes(['middleware' => ['auth:sanctum']]);

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test-email', function () {
    Mail::raw('This is a test email', function ($message) {
        $message->to('rahul@forstu.co')  // Change to your email
                ->subject('Test Email');
    });

    return 'Test email sent';
});


Route::match(['get', 'post'], '/mentees/{menteeId}', 'App\Http\Controllers\MenteeController@menteedash')->name('mentees');

Route::match(['get', 'post'], '/login', 'App\Http\Controllers\LoginRegController@login')->name('login');

Route::match(['get', 'post'], '/register1', 'App\Http\Controllers\LoginRegController@register1')->name('register1');
Route::match(['get', 'post'], '/register2', 'App\Http\Controllers\LoginRegController@register2')->name('register2');


Route::match(['get', 'post'], '/mentorregister', 'App\Http\Controllers\LoginRegController@mentorregister')->name('mentorregister');

Route::match(['get', 'post'], '/registermentor', 'App\Http\Controllers\LoginRegController@registermentor')->name('registermentor');

Route::match(['get', 'post'], '/registermentee', 'App\Http\Controllers\LoginRegController@registermentee')->name('registermentee');

Route::match(['get','post'],'/logged','App\Http\Controllers\LoginRegController@show')->name('logged');

// Route::match(['get','post'],'/tickets','App\Http\Controllers\LoginRegController@tickets')->name('tickets');

Route::match(['get','post'],'/session/{mentorId]','App\Http\Controllers\SessionController@session')->name('session');

Route::match(['get','post'],'/mentor/{mentorId}','App\Http\Controllers\MentorController@mentor')->name('mentor');


Route::match(['get','post'],'/sessionstore','App\Http\Controllers\SessionController@sessionstore')->name('sessionstore');

Route::match(['get','post'],'/sessiondelete/{id}','App\Http\Controllers\SessionController@sessiondelete')->name('sessiondelete');

Route::match(['get','post'],'/sessionupdate/{id}','App\Http\Controllers\SessionController@sessionupdate')->name('sessionupdate');

Route::match(['get','post'],'/sessionedit/{id}','App\Http\Controllers\SessionController@sessionedit')->name('sessionedit');

Route::match(['get','post'],'/admin','App\Http\Controllers\AdminController@admin')->name('admin');

Route::match(['get','post'],'/adminstore','App\Http\Controllers\AdminController@adminstore')->name('adminstore');

Route::match(['get','post'],'/mapping','App\Http\Controllers\MappingController@map')->name('mapping');

Route::match(['get','post'],'/mappingstore','App\Http\Controllers\MappingController@mappingstore')->name('mappingstore');

Route::match(['get','post'],'/sessionjoin/{id}','App\Http\Controllers\SessionController@sessionjoin')->name('sessionjoin');

Route::match(['get','post'],'/menteesession','App\Http\Controllers\SessionController@menteesession')->name('menteesession');

Route::match(['get','post'],'/storefeedback/{id}','App\Http\Controllers\SessionController@storefeedback')->name('storefeedback');

Route::match(['get','post'],'/MarkAttendance/{id}','App\Http\Controllers\SessionController@MarkAttendance')->name('MarkAttendance');

Route::match(['get','post'],'/ShowTask/{mentorId}','App\Http\Controllers\TasksController@ShowTask')->name('ShowTask');

Route::match(['get','post'],'/StoreTask/{mentorId}','App\Http\Controllers\TasksController@StoreTask')->name('StoreTask');

//view chat blade
Route::match(['get','post'],'/showchat','App\Http\Controllers\ChatController@showchat')->name('showchat');

// Route::match(['get','post'],'/fetchMessages','App\Http\Controllers\ChatController@fetchMessages')->name('fetchMessages');

// Route::match(['get','post'],'/messages','App\Http\Controllers\ChatController@sendMessage')->name('sendMessage');

Route::post('/send-message',function(\Illuminate\Http\Request $request){
    $message = $request->message;
    $name = $request ->name;
    event(new MessageSent($message,$name));
    return response()->json(['status'=>'success']);
});

// View chat blade
// Route::get('/showchat', [ChatController::class, 'showchat'])->name('showchat');
// Route::get('/fetchMessages', [ChatController::class, 'fetchMessages'])->name('fetchMessages');
// Route::post('/messages', [ChatController::class, 'sendMessage'])->name('sendMessage');

// routes/web.php

// Routes for creating and storing resources (accessible by mentors)
Route::match(['get', 'post'], '/resources/{mentorId}', 'App\Http\Controllers\ResourceController@show')->name('resources');
Route::match(['get', 'post'], '/storeresources/{mentorId}', 'App\Http\Controllers\ResourceController@store')->name('storeresources');

// Route for displaying pending resources (accessible by admins)
Route::get('/pending', 'App\Http\Controllers\ResourceController@pending')->name('pending');

// Route for approving resources (accessible by admins)
Route::post('/approve/{id}', 'App\Http\Controllers\ResourceController@approve')->name('approve');



Route::match(['get','post'],'/viewmenteeresources/{menteeId}','App\Http\Controllers\ResourceController@viewmenteeresources')->name('viewmenteeresources');

// Route::get('/menteeresources/{mentee_id}','App\Http\Controllers\ResourceController@menteeResources')->name('menteeresources');


// Route::match(['get','post'],'/viewjobs/{mentorId}','App\Http\Controllers\JobController@view')->name('viewjobs');

// Route::match(['get','post'],'/storejobs/{mentorId}','App\Http\Controllers\JobController@store')->name('storejobs');

// Route::match(['get','post'],'/jobs/{mentorId}','App\Http\Controllers\JobController@jobs')->name('jobs');

// Route::match(['get','post'],'/adminjobstore','App\Http\Controllers\JobController@adminjobstore')->name('adminjobstore');

// Route::match(['get','post'],'/adminjobs','App\Http\Controllers\JobController@adminjobs')->name('adminjobs');

// Route::match(['get','post'],'/modules/{mentorId}','App\Http\Controllers\ModulesController@modules')->name('modules');

// Route::match(['get','post'],'/chapters','App\Http\Controllers\ModulesController@chapters')->name('chapters');

// Route::match(['get','post'],'/chapterscontent','App\Http\Controllers\ModulesController@chapterscontent')->name('chapterscontent');


Route::match(['get','post'],'/quiz','App\Http\Controllers\ModulesController@quiz')->name('quiz');

//sample

Route::match(['get','post'],'/dashboardmentee','App\Http\Controllers\MenteeController@show')->name('dashboardmentee');
Route::match(['get','post'],'/admindashboard','App\Http\Controllers\AdminController@dashboard')->name('admindashboard');

Route::match(['get','post'],'/taskmentee','App\Http\Controllers\MenteeController@task')->name('taskmentee');

Route::match(['get','post'],'/modules','App\Http\Controllers\MenteeController@modules')->name('modules');

Route::match(['get','post'],'/chapters','App\Http\Controllers\MenteeController@chapters')->name('chapters');

Route::match(['get','post'],'/JsIntro','App\Http\Controllers\MenteeController@JsIntro')->name('JsIntro');

Route::match(['get','post'],'/quizJsIntro','App\Http\Controllers\ModulesController@quizJsIntro')->name('quizJsIntro');

Route::match(['get','post'],'/publicresources','App\Http\Controllers\MenteeController@publicresources')->name('publicresources');

Route::match(['get','post'],'/displayresources','App\Http\Controllers\MenteeController@displayresources')->name('displayresources');

Route::match(['get','post'],'/calender','App\Http\Controllers\MenteeController@calender')->name('calender');

Route::match(['get','post'],'/moduleresources','App\Http\Controllers\ModulesController@moduleresources')->name('moduleresources');

Route::match(['get','post'],'/displaymoduleresources','App\Http\Controllers\ModulesController@displaymoduleresources')->name('displaymoduleresources');

Route::match(['get','post'],'/tickets','App\Http\Controllers\MenteeController@tickets')->name('tickets');

Route::match(['get','post'],'/menteeticket','App\Http\Controllers\MenteeController@menteeticket')->name('menteeticket');

Route::match(['get','post'],'/jobs','App\Http\Controllers\MenteeController@opportunities')->name('jobs');

Route::match(['get','post'],'/jobdetails1','App\Http\Controllers\MenteeController@jobdetails1')->name('jobdetails1');

Route::match(['get','post'],'/sessionmentee','App\Http\Controllers\MenteeController@sessionmentee')->name('sessionmentee');


//  ================ Mentor List ================= 

Route::match(['get','post'],'/dashboardmentor','App\Http\Controllers\MentorController@dashboardmentor')->name('dashboardmentor');

Route::match(['get','post'],'/mentorsessionadd','App\Http\Controllers\MentorController@mentorsessionadd')->name('mentorsessionadd');

Route::match(['get','post'],'/mentortaskadd','App\Http\Controllers\MentorController@mentortaskadd')->name('mentortaskadd');
