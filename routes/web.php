<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CableController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VideoController;



Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');

Route::get('/admin/dashboard', function () {
return view('admin.dashboard');
})->middleware('auth');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth')->name('admin.dashboard');

Route::get('/video', [VideoController::class, 'index'])->name('admin.video.index');
Route::put('/video/update', [VideoController::class, 'update'])->name('admin.video.update');

Route::post('/logout', [AuthController::class, 'logout'])
->middleware('auth')
->name('logout');

Route::get('/', [CableController::class, 'index'])->name('cable.index');
Route::get('/simulasi', function () {
    return view('cable.simulasi');
});
Route::get('/materi1', function () {
    return view('cable.materi1');
});
Route::get('/materi2', function () {
    return view('cable.materi2');
});
Route::get('/materi3', function () {
    return view('cable.materi3');
});
Route::get('/analisisnilai', function () {
    return view('cable.analisisnilai');
});

Route::get('/tambahmateri', function () {
    return view('admin.tambahmateri');
});

Route::get('/admin/materi/materiadmin', function () {
    return view('admin.materi.materiadmin');
});

Route::get('/admin/materi/index', 
    [MateriController::class, 'index']
)->name('materi.index')->middleware('auth');

Route::post('/materi/store',
    [MateriController::class,'store'])
    ->name('materi.store');

Route::post('/materi/{id}/complete-step',
    [MateriController::class,'completeStep'])
    ->name('materi.completeStep');

Route::resource('materi', MateriController::class);

Route::get('/materi/{id}/edit', [MateriController::class, 'edit'])
    ->name('materi.edit');

Route::put('/materi/{id}', [MateriController::class, 'update'])
    ->name('materi.update');

Route::post('/check', [CableController::class, 'check'])->name('cable.check');
Route::post('/shuffle', [CableController::class, 'shuffle'])->name('cable.shuffle');