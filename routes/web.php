<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Halaman Utama (Katalog & Detail Konser)
Route::get('/', [EventController::class, 'index'])->name('home');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');

// Halaman Dashboard & Transaksi User (Membutuhkan Login)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [OrderController::class, 'index'])->name('dashboard');
    
    Route::get('/checkout', [OrderController::class, 'create'])->name('checkout.create');
    Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/pay', [OrderController::class, 'pay'])->name('orders.pay');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Group Route Khusus Admin Panel
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::patch('/orders/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('orders.updateStatus');
        
        // Rute Manajemen Event Konser (CRUD)
        Route::get('/events/create', [AdminController::class, 'createEvent'])->name('events.create');
        Route::post('/events', [AdminController::class, 'storeEvent'])->name('events.store');
        
        // Rute Edit & Update Event (BARU)
        Route::get('/events/{id}/edit', [AdminController::class, 'editEvent'])->name('events.edit');
        Route::put('/events/{id}', [AdminController::class, 'updateEvent'])->name('events.update');
        
        // Rute Hapus Event
        Route::delete('/events/{id}', [AdminController::class, 'destroyEvent'])->name('events.destroy');
    });
});

require __DIR__.'/auth.php';