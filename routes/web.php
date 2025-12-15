<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SettingsController;




// Authentication Routes

Route::middleware('admin')->group(function () {
 
Route::get('/dashboard', [PageController::class, 'dashboard'])->name('admin.dashboard');
});



  Route::get('/login', function () {
    return view('auth.login');
})->name('admin.login');

Route::get('/register', function () {
    return view('auth.register');
})->name('admin.register');


// ----------------------------------------------------------------------------------------------------------------------



Route::match(['get', 'post'], '/register', [AdminController::class, 'register'])->name('admin.register.submit');
Route::match(['get', 'post'], '/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');


// ---------------------------------------------------------------------------------------------------------------------

// Route::get('/dashboard', function () {
//     return view('layouts.dashboard');
// })->name('admin.dashboard');


// --------------------------------------------------------------------------------------------------------------------------
// Pages Routes]
Route::match(['get', 'post'], '/add-page', [PageController::class, 'create'])->name('admin.addpage');
Route::get('/edit-page/{id}', [PageController::class, 'edit'])->name('admin.editpage');
Route::post('/update-page/{id}', [PageController::class, 'update'])->name('admin.updatepage');
Route::get('/view-page', [PageController::class, 'index'])->name('admin.pages.index');

// Menu Routes
// Route::match(['get', 'post'], '/add-menu', [MenuController::class, 'create'])->name('admin.addmenu');
Route::match(['get', 'post'], '/update-settings', [AdminController::class, 'settings'])->name('admin.settings');
Route::get('/settings/remove/{field}', [AdminController::class, 'removeImage'])
    ->name('admin.removeSettingImage');




