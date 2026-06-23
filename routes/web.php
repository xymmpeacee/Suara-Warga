<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\UpvoteController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

/*
|--------------------------------------------------------------------------
| Public Routes (Landing, Buat Aduan, Lacak Status)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $stats = [
        'total' => \App\Models\Complaint::count(),
        'diproses' => \App\Models\Complaint::where('status', 'diproses')->count(),
        'selesai' => \App\Models\Complaint::where('status', 'selesai')->count(),
    ];
    $recentComplaints = \App\Models\Complaint::withCount('responses')->latest()->take(3)->get();
    return view('welcome', compact('stats', 'recentComplaints'));
})->name('home');

// Buat Aduan
Route::get('/buat-aduan', [ComplaintController::class, 'create'])->name('buat-aduan');
Route::post('/buat-aduan', [ComplaintController::class, 'store'])->name('buat-aduan.store');
Route::get('/buat-aduan/sukses/{complaint}', [ComplaintController::class, 'success'])->name('buat-aduan.sukses');

// Lacak Status
Route::get('/lacak-status', [ComplaintController::class, 'index'])->name('lacak-status');

// Detail aduan (JSON untuk modal)
Route::get('/aduan/{complaint}', [ComplaintController::class, 'show'])->name('aduan.show');

// Upvote
Route::post('/aduan/{complaint}/upvote', [UpvoteController::class, 'store'])->name('aduan.upvote');

/*
|--------------------------------------------------------------------------
| Admin Routes (guard: admin)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    // Auth (guest admin only)
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('login', [AdminAuthController::class, 'login'])->name('login.submit');
    });

    // Protected (authenticated admin)
    Route::middleware('auth:admin')->group(function () {
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::put('dashboard/{complaint}', [AdminDashboardController::class, 'update'])->name('dashboard.update');
        Route::delete('dashboard/{complaint}', [AdminDashboardController::class, 'destroy'])->name('complaint.destroy');
    });
});
