<?php

use App\Http\Controllers\OfficeController;
use App\Http\Controllers\OfficeCategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RepresentativeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/office.index', [OfficeController::class, 'index'])->name('office.index');
Route::post('/office/store', [OfficeController::class, 'store'])->name('office.store');
Route::get('/office.ui.office_list', [OfficeController::class, 'list'])->name('office.ui.office_list');
Route::get('/office/{id}/edit', [OfficeController::class, 'edit'])->name('office.edit');
Route::put('/office/{id}', [OfficeController::class, 'update'])->name('office.update');
Route::delete('/office/{id}', [OfficeController::class, 'destroy'])->name('office.destroy');



Route::POST('/office.office_type.store', [OfficeCategoryController::class, 'store'])->name('office.office_type.store');
Route::get('/office.office_type', [OfficeCategoryController::class, 'show'])->name('office.office_type');
Route::get('/office-category/{id}/edit', [OfficeCategoryController::class, 'edit'])->name('office.category.edit');
Route::put('/office-category/{id}', [OfficeCategoryController::class, 'update'])->name('office.category.update');
Route::delete('/office/category/{id}', [OfficeCategoryController::class, 'destroy'])->name('office.category.destroy');



Route::get('/representatives.create_representatives', [RepresentativeController::class, 'show'])->name('representatives.create_representatives');
Route::post('/representatives.store', [RepresentativeController::class, 'store'])->name('representatives.store');
Route::get('/representatives', [RepresentativeController::class, 'index'])->name('representatives.index');
Route::get('/representatives/{id}/edit', [RepresentativeController::class, 'edit'])->name('representatives.edit');
Route::put('/representatives/{id}', [RepresentativeController::class, 'update'])->name('representatives.update');
Route::delete('/representatives/{id}', [RepresentativeController::class, 'destroy'])->name('representatives.destroy');



Route::POST('/representative.post_category.store', [PostCategoryController::class, 'store'])->name('representative.post_category.store');
Route::get('/representatives.post_category', [PostCategoryController::class, 'show'])->name('representatives.post_category');
Route::get('/representative/post_category/{id}/edit', [PostCategoryController::class, 'edit'])->name('representative.post_category.edit');
Route::put('/representative.post_category/{id}', [PostCategoryController::class, 'update'])->name('representative.post_category.update');
Route::delete('/post/category/{id}', [PostCategoryController::class, 'destroy'])->name('representative.post_category.destroy');
