<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PostController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('event/userscount/{id}',['\App\Http\Controllers\API\EventController',"users_Count"]); // how many users will go the event
Route::get('event/single-event/{id}',['\App\Http\Controllers\API\EventController',"single"]); // get event details for guest
Route::get('event/nonactive',['App\Http\Controllers\API\EventController',"events_nonactive"]); // non active event
Route::put('event/change/{id}',['\App\Http\Controllers\API\EventController',"change_state"]); // change state active non active
Route::get('event/active',['\App\Http\Controllers\API\EventController',"events_active"]); // active event
Route::post('event/teacher_events',['\App\Http\Controllers\API\EventController',"teacher_events"]); // events created by the teacher
Route::post('event/inroll_index',['\App\Http\Controllers\API\EventController',"events_for_users"]); // events user will go
Route::post('event/search_inrollement',['\App\Http\Controllers\API\EventController',"search_inrollement"]);
Route::post('event/inroll_add',['\App\Http\Controllers\API\EventController',"event_inroll"]);  // user is in rolling in event
Route::delete('event/inroll_destroy',['\App\Http\Controllers\API\EventController',"event_outroll"]); // user is out rolling in event
Route::get('event/teacherbyid/{id}',['\App\Http\Controllers\API\EventController',"certian_teacher"]);
Route::post('event/search_for_teacher_events',['\App\Http\Controllers\API\EventController',"search_for_teacher_events"]);
route::apiResource("event","App\Http\Controllers\API\EventController");


Route::group([
    'middleware' => 'api',
    'prefix' => 'event-notification'
], function () {
    Route::post('create',['\App\Http\Controllers\Api\EventNotification',"create"]);
    Route::get('show',['\App\Http\Controllers\Api\EventNotification',"show"]);
    Route::get('update/{id}',['\App\Http\Controllers\Api\EventNotification',"update"]);
});


route::apiResource("normaluser","App\Http\Controllers\API\NormalUserController");
route::apiResource("eventcats","App\Http\Controllers\API\EventCatsController");
route::apiResource("teacher","App\Http\Controllers\API\TeacherController");
route::apiResource("comment","App\Http\Controllers\API\UserPostCommentController");
route::apiResource("teachercomment","App\Http\Controllers\API\TeacherPostCommentController");
route::apiResource("likes","App\Http\Controllers\API\UserPostLikeController");
Route::get('likes/countlikes/{id}',['App\Http\Controllers\API\UserPostLikeController',"likes_count"]); 
// Route::get('comment/join/{id}',['App\Http\Controllers\API\UserPostCommentController',"comments"]); 






// route::post('file','PostController@file');


// route::apiResource("auth","App\Http\Controllers\Auth\AuthController");


Route::post('class-notification/create',['\App\Http\Controllers\API\ClassController',"notify_teacher"]);
Route::get('class-notification/show',['\App\Http\Controllers\API\ClassController',"notify_teacher_show"]);
Route::get('class-notification/update/{id}',['\App\Http\Controllers\API\ClassController',"notify_teacher_update"]);

Route::delete('classes/check-destroy/{id}',['\App\Http\Controllers\API\ClassController',"check_destroy"]);
Route::put('classes/activate/{id}',['\App\Http\Controllers\API\ClassController',"make_class_active"]);
Route::get('classes/allclasses',['\App\Http\Controllers\API\ClassController',"AllClasses"]);
route::apiResource("classes","App\Http\Controllers\API\ClassController");
Route::get('teachers-classes',['\App\Http\Controllers\API\ClassController',"teachers_classes"]);


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {

    Route::post('login',['\App\Http\Controllers\Auth\AuthController',"login"]);
    Route::post('logout',['\App\Http\Controllers\Auth\AuthController',"logout"]);
    Route::post('refresh',['\App\Http\Controllers\Auth\AuthController',"refresh"]);
    Route::get('me',['\App\Http\Controllers\Auth\AuthController',"me"]);
    Route::post('signupuser',['\App\Http\Controllers\Auth\AuthController',"signupuser"]);
   
    Route::post('signupteacher',['\App\Http\Controllers\Auth\AuthController',"signupteacher"]);

});


route::apiResource("classescats","App\Http\Controllers\API\ClassCatsController");
Route::get('classcats/{id}',['\App\Http\Controllers\API\EventCatsController',"classcat"]);
Route::get('classcats/{id}',['\App\Http\Controllers\API\EventCatsController',"classcat"]);
route::apiResource("myclasses","App\Http\Controllers\API\MyClassController");
Route::post('myclasses/rate',["App\Http\Controllers\API\MyClassController",'myClassRate']);
Route::get('myclasses/totalRate/{id}',["App\Http\Controllers\API\MyClassController",'totalRating']);
Route::get('eventcat/{id}',['\App\Http\Controllers\API\EventCatsController',"eventcat"]);

Route::get('myclasses/user-video-owner-check/{id}',["App\Http\Controllers\API\MyClassController",'video_owner_check']); //check if user have purshased the cousre usung video id ////
Route::get('myclasses/user-class-owner-check/{id}',["App\Http\Controllers\API\MyClassController",'class_owner_check']); //check if user have purshased the cousre usung video id ////
Route::post('class/comment',["App\Http\Controllers\API\classcommentcontroller",'class_user_comment']); //check if user have purshased the cousre usung video id ////
route::apiResource("classComment","App\Http\Controllers\API\classcommentcontroller"); //check if user have purshased the cousre usung video id ////
Route::get('classComment/{id}',['App\Http\Controllers\API\classcommentcontroller',"comments_count"]);

Route::group([
    'middleware' => 'api',
    'prefix' => 'class-content'
], function () {
    Route::get('all-videos-class/{id}',['\App\Http\Controllers\Api\ClassContentController',"index"]); //all videos for this class
    Route::get('all-videos-class-by_vid-id/{id}',['\App\Http\Controllers\Api\ClassContentController',"indox"]); //all videos for this class
    Route::post('add-on-class',['\App\Http\Controllers\Api\ClassContentController',"create"]); //id for class
    Route::get('show-video/{id}',['\App\Http\Controllers\Api\ClassContentController',"show"]); //id for video
    Route::put('update-video/{id}',['\App\Http\Controllers\Api\ClassContentController',"update"]); //id for video
    Route::delete('delete-video/{id}',['\App\Http\Controllers\Api\ClassContentController',"delete"]); //id for video
    Route::get('/video/{id}',['\App\Http\Controllers\Api\ClassContentController',"check_video_permission"]); //ckeck of teacher video permission
    Route::get('/ccllaass/{id}',['\App\Http\Controllers\Api\ClassContentController',"check_class_permission"]); //ckeck of teacher class permission
});


Route::group([
    'middleware' => 'api',
], function () {
    Route::put('update-content/{id}',['\App\Http\Controllers\Api\UserClassContentController',"update"]); //id for video
    Route::get('get-user-videos/{id}',['\App\Http\Controllers\Api\UserClassContentController',"check_videos_seen"]); //id for video
});




Route::post('post-notification/create',['\App\Http\Controllers\API\PostController',"notify_teacher"]);
Route::get('post-notification/show',['\App\Http\Controllers\API\PostController',"notify_teacher_show"]);
Route::get('post-notification/update/{id}',['\App\Http\Controllers\API\PostController',"notify_teacher_update"]);
Route::put('post/activate/{id}',['\App\Http\Controllers\API\PostController',"make_post_active"]);

Route::get('/teacher-posts',['\App\Http\Controllers\Api\PostController',"all_teacher_posts"]);
Route::get('/active-posts',['\App\Http\Controllers\Api\PostController',"show_active_posts"]);
route::apiResource("post","App\Http\Controllers\API\PostController");
