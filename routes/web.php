<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\User\FormViewController;
use App\Http\Controllers\Admin\SubmissionController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('home'));
Route::get('/about', fn() => view('about'));

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Optional default redirect for logged-in users
Route::get('/home', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Admin Routes (Only for role: admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('dashboard');

    // Form Builder
    Route::get('/form-builder', [FormController::class, 'create'])->name('form-builder');
    Route::post('/forms', [FormController::class, 'store'])->name('forms.store');

    // Form Management
    Route::get('/forms', [FormController::class, 'index'])->name('forms.index');
    Route::get('/forms/{form}', [FormController::class, 'preview'])->name('forms.preview');
    Route::patch('/forms/{form}/toggle', [FormController::class, 'toggle'])->name('forms.toggle');
    Route::delete('/forms/{form}', [FormController::class, 'destroy'])->name('forms.destroy');

    // Submissions
    Route::get('/submissions', [SubmissionController::class, 'index'])->name('submissions');
});

/*
|--------------------------------------------------------------------------
| User Routes (Only for role: user)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isUser'])->prefix('user')->name('user.')->group(function () {
    Route::get('/forms', [FormViewController::class, 'index'])->name('forms');
});

// Form Viewing + Submission (for authenticated users with user role)
Route::middleware(['auth', 'isUser'])->group(function () {
    Route::get('/form/{form}', [FormViewController::class, 'show'])->name('user.form.view');
    Route::post('/form/{form}/submit', [FormViewController::class, 'submit'])->name('user.form.submit');
});



Route::middleware(['auth', 'isUser'])->prefix('user')->name('user.')->group(function () {
    Route::view('/dashboard', 'user.dashboard')->name('dashboard'); // ✅ Add this
    Route::get('/forms', [FormViewController::class, 'index'])->name('forms');
});







// All the routes are 
// home
// about
// login
// register
// logout
// admin.dashboard
// admin.form-builder
// admin.forms
// admin.forms.preview
// admin.forms.toggle
// admin.forms.destroy
// admin.submissions
// user.forms
// user.form.view
// user.form.submit     