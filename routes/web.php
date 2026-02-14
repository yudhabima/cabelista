<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CableController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AdminController;


Route::get('/course/edit', [CourseController::class, 'edit'])->name('course.edit');
Route::post('/course/update', [CourseController::class, 'update'])->name('course.update');
Route::get('/course/preview', [CourseController::class, 'preview'])->name('course.preview');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');

Route::get('/admin/dashboard', function () {
return view('admin.dashboard');
})->middleware('auth');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth')->name('admin.dashboard');

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

Route::post('/check', [CableController::class, 'check'])->name('cable.check');
Route::post('/shuffle', [CableController::class, 'shuffle'])->name('cable.shuffle');