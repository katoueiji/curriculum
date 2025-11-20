<?php

use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventParticipationController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Event_user;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

    Route::get('/userstop', function () {
    return view('auth.userstop');
    })->name('userstop');


Route::middleware('auth')->group(function () {
    Route::get('/', function () {
    $user = auth()->user();
    if ($user->can('admin-higher')) return redirect('/admin');
    if ($user->can('user-higher')) return redirect('/user-home');
    abort(403);
    });

    Route::get('/user/{id}/profile', [DisplayController::class, 'userProfile'])->name('user.profile');
    Route::get('/event/{id}/detail', [DisplayController::class, 'eventDetail'])->name('event.detail');

    Route::group(['middleware' => ['auth', 'can:user-higher']], function () {
        Route::get('user-home', [DisplayController::class, 'index']);
        
        Route::get('/sort', [DisplayController::class, 'sort'])->name('sort');
        Route::get('/event/{id}/main', [UserController::class, 'eventMainform'])->name('event.main');
        Route::get('/user/{id}/join', [UserController::class, 'userJoinform'])->name('user.join');

        Route::get('/event/{id}/join', [EventParticipationController::class, 'eventJoinform'])->name('event.join');
        Route::post('/event/{id}/join', [EventParticipationController::class, 'eventJoin']);

        Route::get('/event/{id}/report', [EventParticipationController::class, 'eventReportform'])->name('event.report');
        Route::post('/event/{id}/report', [EventParticipationController::class, 'eventReport']);

        Route::get('/event/{id}/edit', [EventController::class, 'eventEditform'])->name('event.Edit');
        Route::post('/event/{id}/edit', [EventController::class, 'eventEdit']);

        Route::get('/event/{id}/edit/destroy', [EventController::class, 'eventDestroyform'])->name('event.Destroy');
        Route::post('/event/{id}/edit/destroy', [EventController::class, 'eventDestroy']);

        Route::get('/event/{id}/create', [EventController::class, 'eventCreateform'])->name('event.Create');
        Route::post('/event/{id}/create', [EventController::class, 'eventCreate']);


        Route::get('/user/{id}/profile/edit', [UserController::class, 'profileEditform'])->name('profile.edit');
        Route::post('/user/{id}/profile/edit', [UserController::class, 'profileEdit']);

        Route::get('/user/{id}/user/edit', [UserController::class, 'userEdit'])->name('user.edit');
        Route::post('/user/{id}/user/edit', [UserController::class, 'delete']);

        Route::get('/user/{id}/join/cancel', [EventParticipationController::class, 'userCancelform'])->name('user.cancel');
        Route::post('/user/{id}/join/cancel', [EventParticipationController::class, 'userCancel']);

        Route::post('/bkm_product', [BookmarkController::class, 'toggle'])->name('bkm_product');
        Route::get('/bookmark', [UserController::class, 'bookmark_event'])->name('bookmark');

    });
        Route::group(['middleware' => ['auth', 'can:admin-higher']], function () {

        Route::get('/admin', [AdminController::class, 'top']);

        Route::get('/event', [AdminController::class, 'eventAll'])->name('event.all');
        Route::get('/user', [AdminController::class, 'userAll'])->name('user.all');
        Route::get('/joinuser', [AdminController::class, 'joinuser'])->name('join.user');

        Route::get('/event/{id}/hidden', [AdminController::class, 'eventHiddenform'])->name('event.hidden');
        Route::post('/event/{id}/hidden', [AdminController::class, 'eventHidden']);

        Route::get('/event/{id}/active', [AdminController::class, 'eventActiveform'])->name('event.active');
        Route::post('/event/{id}/active', [AdminController::class, 'eventActive']);

        Route::get('/user/{id}/active', [AdminController::class, 'userActiveform'])->name('user.active');
        Route::post('/user/{id}/active', [AdminController::class, 'userActive']);

        Route::get('/user/{id}/hidden', [AdminController::class, 'userHiddenform'])->name('user.hidden');
        Route::post('/user/{id}/hidden', [AdminController::class, 'userHidden']);
    });


});


