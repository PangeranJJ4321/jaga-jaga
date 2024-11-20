<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DetailEventController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FavoritEventController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/en/home', [WelcomeController::class, 'index'])->name('home');
// Route::get('/', function() {
//     return view('partials.favorites');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


// Redirect to the appropriate dashboard after login
Route::middleware('auth')->get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

// Admin dashboard route
Route::middleware('auth')->get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// Organizer dashboard route
Route::middleware('auth')->get('/organizer/dashboard', [OrganizerController::class, 'index'])->name('organizer.dashboard');
// User dashboard route
Route::middleware('auth')->get('/user/dashboard', [HomeController::class, 'userDashboard'])->name('user.dashboard');


// Route bagian welcome

Route::get('/en/events', [EventController::class, 'browseEvents'])->name('browse.events'); 
Route::get('/en/events', [EventController::class, 'showEvents'])->name('events.index');
Route::get('/en/events/category/{category}', [EventController::class, 'exploreCategory'])->name('explore.category'); // Untuk menampilkan event berdasarkan kategori
Route::get('/en/events/detail', [DetailEventController::class, 'show'])->name('event.show');
Route::post('/en/events/detail', [DetailEventController::class, 'store'])->name('reviews.store');
Route::get('/en/events/detail/{eventId}', [DetailEventController::class, 'sameEvent']);


Route::post('/favorite/toggle', [FavoriteController::class, 'toggleFavorite'])->name('favorite.toggle');

// Mendapatkan semua review untuk event tertentu
Route::get('/reviews/get/{event_id}', [ReviewController::class, 'getReviews'])->name('reviews.get');

// Menyimpan review baru
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

// Menghapus review
Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

// Route untuk daftar favorit
Route::get('/en/dashboard/attendee/favorite-events', [FavoritEventController::class, 'index'])->name('favorits.index')->middleware('auth');

// Route untuk menghapus favorit
Route::delete('/en/dashboard/attendee/favorite-events/{id}', [FavoritEventController::class, 'destroy'])->name('favorits.destroy')->middleware('auth');

// Route untuk ke myticket
Route::get('/en/dashboard/attendee/my-tickets', [TicketController::class, 'index'])
    ->name('tickets.index')
    ->middleware('auth');

Route::get('/en/dashboard/attendee/my-tickets/{ticketCode}', [TicketController::class, 'show'])
    ->name('tickets.show')
    ->middleware('auth');

Route::patch('/en/dashboard/attendee/my-tickets/{ticketCode}/cancel', [TicketController::class, 'cancel'])
    ->name('tickets.cancel')
    ->middleware('auth');

// Route::get('/en/dashboard/attendee/my-tickets', [EventController::class, 'myTickets'])->middleware('auth')->name('my.tickets');
// Route::get('/en/dashboard/attendee/favorite-events', [EventController::class, 'myFavoriteEvents'])->middleware('auth')->name('my.favorite.events');
require __DIR__.'/auth.php';
