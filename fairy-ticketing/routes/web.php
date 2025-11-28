<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventDetailController;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\FavoriteController;
use App\Http\Controllers\Organizer\DashboardController as OrganizerDashboard;
use App\Http\Controllers\Organizer\EventController as OrganizerEventController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EventController as AdminEventController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/event/{id}', [EventDetailController::class, 'show'])->name('event.show');

// Auth Routes
require __DIR__.'/auth.php';

// Pending Page for Organizer
Route::get('/pending', function() {
    if (auth()->user()->role !== 'organizer') {
        return redirect()->route('home');
    }
    return view('pending');
})->middleware('auth')->name('pending');

// Delete Account for Rejected Organizer
Route::delete('/delete-account', function() {
    $user = auth()->user();
    if ($user->role === 'organizer' && $user->status === 'rejected') {
        $user->delete();
        return redirect()->route('home')->with('success', 'Account deleted successfully!');
    }
    return back();
})->middleware('auth')->name('delete.account');

// User Routes
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function() {
    Route::get('/dashboard', [UserDashboard::class, 'index'])->name('dashboard');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{id}', [BookingController::class, 'show'])->name('booking.show');
    Route::post('/booking/{id}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');
    Route::post('/favorite/{event}', [FavoriteController::class, 'toggle'])->name('favorite.toggle');
});

// Organizer Routes
Route::middleware(['auth', 'role:organizer'])->prefix('organizer')->name('organizer.')->group(function() {
    Route::get('/dashboard', [OrganizerDashboard::class, 'index'])->name('dashboard');
    Route::resource('events', OrganizerEventController::class);
    Route::get('/event/{event}/add-ticket', [OrganizerEventController::class, 'addTicket'])->name('event.add-ticket');
    Route::post('/event/{event}/store-ticket', [OrganizerEventController::class, 'storeTicket'])->name('event.store-ticket');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function() {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    // Manage Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/{id}/approve', [UserController::class, 'approve'])->name('users.approve');
    Route::post('/users/{id}/reject', [UserController::class, 'reject'])->name('users.reject');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Manage Events (Admin bisa tambah/edit/delete event)
    Route::get('/events', [AdminEventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [AdminEventController::class, 'create'])->name('events.create');
    Route::post('/events', [AdminEventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}/edit', [AdminEventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [AdminEventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [AdminEventController::class, 'destroy'])->name('events.destroy');
    Route::get('/events/{event}/add-ticket', [AdminEventController::class, 'addTicket'])->name('events.add-ticket');
    Route::post('/events/{event}/tickets', [AdminEventController::class, 'storeTicket'])->name('events.store-ticket');

    #Ticket
    Route::get('/admin/reports/sales', [\App\Http\Controllers\Admin\ReportController::class, 'sales'])->name('admin.reports.sales');
});

