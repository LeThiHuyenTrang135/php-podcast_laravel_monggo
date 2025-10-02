<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Podcaster\PodCasterController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Podcast\PodcastController;
use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\PodcasterFollower\PodcasterFollowerController;
use App\Http\Controllers\Contact\ContactController;

Route::middleware(['web'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');

    Route::get('/about', fn () => view('about'))->name('about')->middleware('verified');

    // Contact
    Route::get('/contact',  [ContactController::class, 'index'])->name('contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    // Social auth
    Route::prefix('auth')->as('auth.')->group(function () {
        Route::get('/{provider}/redirect', [AuthController::class, 'redirectSocial'])->name('social.redirect');
        Route::get('/{provider}/callback', [AuthController::class, 'callbackSocial'])->name('social.callback');
    });

    // Auth (tự khai báo) — KHÔNG dùng Auth::routes()
    Route::get('/login',    [AuthController::class, 'getLogin'])->name('get_login');
    Route::post('/login',   [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'getRegister'])->name('get_register');
    Route::post('/register',[AuthController::class, 'register'])->name('register');
    Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');

    // Email verification (phải đăng nhập)
    Route::middleware('auth')->group(function () {
        Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
        Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
            ->middleware('signed')->name('verification.verify');
        Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
            ->middleware('throttle:6,1')->name('verification.resend'); // ← đặt tên này, trùng với view
    });

    // Forgot/Reset password
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

    // Podcast
    Route::get('/podcast/redirect/{podcast}', [PodcastController::class, 'redirectByPodcastId'])->name('podcast.redirect');
    Route::get('/{category}/podcast/{id}', [PodcastController::class, 'podcast_detail'])->name('podcast.podcast_detail');

    // Comments (api via sanctum token)
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
        Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
        Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
    });

    // Follow
    Route::post('/follow',   [PodcasterFollowerController::class, 'follow'])->name('follow');
    Route::post('/unfollow', [PodcasterFollowerController::class, 'unfollow'])->name('unfollow');

    // Podcasters area (đã verify)
    Route::prefix('podcasters')->as('podcasters.')->middleware('verified')->group(function () {
        Route::get('/edit/{podcaster}',   [PodCasterController::class, 'edit'])->name('edit');
        Route::put('/update/{podcaster}', [PodCasterController::class, 'update'])->name('update');
        Route::get('/{podcaster}',        [PodCasterController::class, 'index'])->name('index');
    });

    // CRUD podcast
    Route::get('/crud/add',             [PodcastController::class, 'loadAddPage'])->name('podcast.loadAddPage');
    Route::post('/crud/add',            [PodcastController::class, 'addPodcast'])->name('podcast.addPodcast');
    Route::delete('/crud/delete/{id}',  [PodcastController::class, 'deletePodcast'])->name('podcast.deletePodcast');
    Route::post('/crud/restore/{id}',   [PodcastController::class, 'restore'])->name('podcast.restore');
    Route::get('/crud/update/{id}',     [PodcastController::class, 'loadUpdatePage'])->name('podcast.loadUpdatePage');
    Route::put('/crud/update/{id}',     [PodcastController::class, 'updatePodcast'])->name('podcast.updatePodcast');
    Route::get('/crud',                 [PodcastController::class, 'index'])->name('podcast.crud');
    Route::get('/podcast/{id}',         [PodcastController::class, 'show']);
});
