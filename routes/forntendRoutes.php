<?php
use App\Http\Controllers\DonationController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\MasbiaDonationController;
use App\Http\Controllers\MasbiaBlogsController;
use Illuminate\Support\Facades\Route;

// Route::middleware('guest')->group(function () {
    Route::get('/', [FrontendController::class, 'index'])->name('home');
    Route::get('/thank-you/{donationID}', [FrontendController::class, 'thank_you'])->name('general.thank-you');

    Route::get('/emailView', function () {
        return view('emails.donor-notification');
    });
    
    Route::get('/campaign/{campaign}/{team?}', [FrontendController::class, 'raffle'])->name('raffle')->middleware('visitor');
    Route::get('/load-more-donations', [DonationController::class, 'loadMoreDonations']);
    Route::get('/load-more-teams', [DonationController::class, 'loadMoreTeams']);
    Route::get('/load-more-team-donations', [DonationController::class, 'loadMoreTeamDonations']);
    
    Route::post('/payment/{campaign}', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::post('/campaign/create_team', [FrontendController::class, 'create_team'])->name('campaign.create_team');

    Route::get('masbia/donation', [MasbiaDonationController::class, 'index'])->name('donation.index');
    Route::get('masbia/blogs', [MasbiaBlogsController::class, 'index'])->name('blogs.index');
    Route::get('masbia/blog/{title}', [MasbiaBlogsController::class, 'view'])->name('blogs.view');
    Route::get('blogs/get-blogs', [MasbiaBlogsController::class, 'getBlogs'])->name('blogs.get-blogs');
// });

Route::middleware('auth')->group(function () {
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profileupdate', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('notification', [NotificationController::class, 'edit'])->name('notification.edit');
    Route::post('notification-update', [NotificationController::class, 'update'])->name('notification.update');
});

// Route::domain('{organization}/{slug}')->group(function () {
// Route::get('/campaign/{organization}/{slug}', [FrontendController::class, 'raffle'])->name('raffle');
// });

