<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\FbPostController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinkedinController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\TwitterLoginController;

use App\Http\Controllers\ScheduledPostController;
use App\Http\Controllers\CalenderController;



//Authentication Route Start
Route::get('/', function () {
    return view('index');
})->name("login");

Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegistrationController::class, 'register']);


// Middleware for authenticated users
Route::middleware('custom_auth')->group(function (){
    Route::post("auth",[AuthController::class,'auth'])->name('auth');   
    Route::get("home",[HomeController::class,'index'])->name('home');
    Route::get("logout",[AuthController::class,'logout'])->name('logout');

});
//Authentication Route End


Route::get('/dashboard',[DashboardController::class,'show'])->name('dashboard');


                    // facebook login & Posting Starts
//facebook login & redirect 
// Route::get('facebook/login', [FacebookController::class, 'redirectToProvider'])->name('facebook.login');
// Route::get('dashboard/callback/facebook', [FacebookController::class, 'handleFacebookCallback']);

Route::get('facebook/login', [FacebookController::class, 'redirectToProvider'])->name('facebook.login');
Route::get('dashboard/callback/facebook', [FacebookController::class, 'handleFacebookCallback']);


// Route::get('/facebook/login', [FacebookController::class, 'redirectToProvider'])->name('facebook.login');
// Route::get('/facebook/callback', [FacebookController::class, 'handleFacebookCallback'])->name('facebook.callback');


//facebook posting
Route::get('/fb-post', function () {
    return view('pages.erp.facebook_post.create'); 
});
Route::post('/posts', [FbPostController::class, 'store'])->name('posts.store');




//twitter login & redirect
Route::get('/twitter/redirect', [TwitterLoginController::class, 'redirectToTwitter'])->name('twitter.login');
Route::get('/dashboard/callback/twitter-connect', [TwitterLoginController::class, 'handleTwitterCallback']);

//twitter posting (tweet)
Route::get('/tweet', [TweetController::class, 'create'])->name('tweet.create');
Route::post('/tweet', [TweetController::class, 'store'])->name('tweet.store');
Route::post("twitterUser",[HomeController::class,'show'])->name('twitterUser');

                    
//Google login
Route::get('google/login', [GoogleController::class, 'redirectToProvider'])->name('google.login');
Route::get('dashboard/google/callback', [GoogleController::class, 'handleProviderCallback']);


//linkedin
Route::get('linkedin/login', [LinkedinController::class, 'provider'])->name('linkedin.login');
Route::get('linkedin/callback', [LinkedinController::class, 'providercallback'])->name('linkedin.user');



//Stripe Payment
Route::get('/payment', [PaymentController::class,'index'])->name('payment');
Route::post('/submit', [PaymentController::class, 'submitPayment'])->name('stripe.submit');




//scheduled_Post
Route::get('/scheduled_posts/create', [ScheduledPostController::class, 'create'])->name('scheduled_posts.create');
Route::post('/scheduled_posts', [ScheduledPostController::class, 'store'])->name('scheduled_posts.store');
Route::get('/scheduled_posts', [ScheduledPostController::class, 'index'])->name('pages.erp.scheduled_posts.index');




//Calendar
Route::get('/calendar', [CalenderController::class, 'index'])->name('calendar');
Route::get('/calendar-event', [CalenderController::class, 'getSchedulePostData'])->name('calendar-event');
Route::resource('pages.erp.scheduled_posts', ScheduledPostController::class);


// Additional route for fetching calendar events
// Route::get('pages/erp/calendar-events', 'ScheduledPostController@calendarEvents')->name('calendar-events');