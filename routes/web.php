<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\UserProfileController;


// Define a route for the form submission
// Route::post('/people_create', [PeopleController::class, 'addPerson'])->name('createpeople');

  Route::get('/subscription', [MainController::class, 'subscription'])->name('subscription');


Route::post('register', 'RegistrationController@store');
Route::middleware('auth')->group(function () {
    Route::get('/', [MainController::class, 'dashboard'])->name('dashboard');
    Route::post('/people_create', [PeopleController::class, 'addPerson'])->name('createpeople');
    // Profile routes, accessible only for authenticated users
  

  Route::get('/video', [VideoController::class, 'index'])->name('video.index');
  Route::post('/video/upload', [VideoController::class, 'videoupload'])->name('video.upload');
  Route::get('/video/{filename}', [VideoController::class, 'videofile'])->name('video.file');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/delete-account', [PeopleController::class, 'delete'])->name('account.delete');
    Route::put('/password-update', [PeopleController::class, 'updatePassword'])->name('password.update');
    Route::get('/people_profile/{id}', [PeopleController::class, 'show']);

    Route::get('/delete-file/{id}', [PeopleController::class, 'deleteFile'])->name('file.delete');



    Route::post('/upload-video', [VideoController::class, 'upload'])->name('video.upload');
});

Route::get('/chat', [ChatController::class, 'index'])
    ->name('chat');


Route::get('/userprofile', [ChatController::class, 'userprofile'])->name('userprofile');

Route::post('/child_user/store', [ChatController::class, 'store'])->name('child_user.store');

// Route::get('/search/videos', [VideoController::class, 'search'])->name('search.videos');

Route::get('/autocomplete', [VideoController::class, 'autocomplete'])->name('autocomplete');


Route::get('/user_login', [MainController::class, 'user_login'])->name('user_login');
Route::post('/entry', [MainController::class, 'validateUserEntry'])->name('user_entry');

Route::post('/send-message', [ChatController::class, 'sendMessage']);

Route::get('/messages', [ChatController::class, 'fetchMessages']);


Route::post('/user_logout', [ChatController::class, 'user_logout'])->name('user_logout');






require __DIR__ . '/auth.php';
