<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\OfficeCategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RepresentativeController;
use App\Http\Controllers\OfficeServiceController;
use App\Http\Controllers\DepartmentController;
use App\Models\ServiceType;
use App\Http\Controllers\ServiceTypeController;
use Database\Factories\UserFactory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostEmployeeController;
use App\Livewire\Users\UserIndex;
use App\Livewire\Users\UserCreate;
use App\Livewire\Users\UserEdit;
use App\Livewire\Users\UserShow;
use App\Models\User;

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

Route::get('/users', function () {
    return view('users.user-index');
});

require __DIR__ . '/auth.php';

Route::get('/office.index', [OfficeController::class, 'index'])->name('office.index');
Route::post('/office/store', [OfficeController::class, 'store'])->name('office.store');
Route::get('/office.ui.office_list', [OfficeController::class, 'list'])->name('office.ui.office_list');
Route::get('/office/{id}/edit', [OfficeController::class, 'edit'])->name('office.edit');
Route::put('/office/{id}', [OfficeController::class, 'update'])->name('office.update');
Route::delete('/office/{id}', [OfficeController::class, 'destroy'])->name('office.destroy');
Route::get('/offices/{id}', [OfficeController::class, 'show'])->name('office.show');
Route::get('/office/create', [OfficeController::class, 'create'])->name('office.create');




Route::POST('/office.office_type.store', [OfficeCategoryController::class, 'store'])->name('office.office_type.store');
Route::get('/office.office_type', [OfficeCategoryController::class, 'show'])->name('office.office_type');
Route::get('/office-category/{id}/edit', [OfficeCategoryController::class, 'edit'])->name('office.category.edit');
Route::put('/office-category/{id}', [OfficeCategoryController::class, 'update'])->name('office.category.update');
Route::delete('/office/category/{id}', [OfficeCategoryController::class, 'destroy'])->name('office.category.destroy');







// Representative routes
Route::get('/representatives.create_representatives', [RepresentativeController::class, 'show'])->name('representatives.create_representatives');
Route::post('/representatives.store', [RepresentativeController::class, 'store'])->name('representatives.store');
Route::get('/representatives/{id}/edit', [RepresentativeController::class, 'edit'])->name('representatives.edit');
Route::put('/representatives/{id}', [RepresentativeController::class, 'update'])->name('representatives.update');
Route::delete('/representatives/{id}', [RepresentativeController::class, 'destroy'])->name('representatives.destroy');
Route::get('/representatives', [RepresentativeController::class, 'index'])->name('representatives.index');
Route::get('/representatives/create', [RepresentativeController::class, 'show'])->name('representatives.create_representatives');


Route::post('representative/post-category/store', [PostCategoryController::class, 'store'])->name('representative.post_category.store');
Route::get('/representatives.post_category', [PostCategoryController::class, 'show'])->name('representatives.post_category');
Route::get('/representative/post_category/{id}/edit', [PostCategoryController::class, 'edit'])->name('representative.post_category.edit');
Route::put('/representative.post_category/{id}', [PostCategoryController::class, 'update'])->name('representative.post_category.update');
Route::delete('/post/category/{id}', [PostCategoryController::class, 'destroy'])->name('representative.post_category.destroy');
Route::get('/departments/{departmentId}/post-categories', [PostCategoryController::class, 'getPostCategoriesByDepartmentId'])->name('departments.post-categories');





Route::get('department/create',[DepartmentController::class,'create'])->name('department.create');
Route::post('department/store',[DepartmentController::class,'store'])->name('department.store');
Route::get('department/index',[DepartmentController::class,'index'])->name('department.index');
Route::get('department/{department}/edit', [DepartmentController::class, 'edit'])->name('department.edit');
Route::put('department/{department}', [DepartmentController::class, 'update'])->name('department.update');
Route::delete('department/{department}', [DepartmentController::class, 'destroy'])->name('department.destroy');


Route::get('office_service/create', [OfficeServiceController::class, 'create'])->name('office_service.create');
Route::get('office_service/index',[OfficeServiceController::class, 'show'])->name('office_service.index');
Route::get('office_service/office_type', [ServiceTypeController::class, 'officetype'])->name('office_service.office_type');
// Route::post('/office_service', [ServiceTypeController::class, 'store'])->name('office_service.office_type.store');
Route::post('office_service/office_type', [ServiceTypeController::class, 'store'])->name('office_service.office_type.store');
Route::post('office_service', [OfficeServiceController::class, 'store'])->name('office_service.store');
Route::get('office_service/{id}/edit', [OfficeServiceController::class, 'edit'])->name('office_service.edit');
Route::put('service_type/{id}', [ServiceTypeController::class, 'update'])->name('service_type.update');
Route::delete('service_type/{id}', [ServiceTypeController::class, 'destroy'])->name('service_type.destroy');



Route::get('/employee', [EmployeeController::class, 'show'])->name('employee.create');
Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
Route::post('/employee.store', [EmployeeController::class, 'store'])->name('employee.store');
Route::get('/employee/{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
Route::put('/employee/{id}', [EmployeeController::class, 'update'])->name('employee.update');
Route::delete('/employee/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
Route::get('/employee/create', [EmployeeController::class, 'show'])->name('employee.create');



Route::post('/employee/post_employee/store', [PostEmployeeController::class, 'store'])->name('employee.post_employee.store');
Route::get('/employee.post_employee', [PostEmployeeController::class, 'show'])->name('employee.post_employee');
Route::get('/employee/post_employee/{id}/edit', [PostEmployeeController::class, 'edit'])->name('employee.post_employee.edit');
Route::put('/employee/post_employee/{id}', [PostEmployeeController::class, 'update'])->name('employee.post_employee.update');
Route::delete('/employee/post_employee/{id}', [PostEmployeeController::class, 'destroy'])->name('employee.post_employee.destroy');
Route::get('/departments/{departmentId}/post-employees', [PostEmployeeController::class, 'getPostEmployeesByDepartmentId'])->name('departments.post-employees');


Route::get("users",UserIndex::class)->name("users.index");
Route::get("users/create",UserCreate::class)->name("users.create");
Route::get("users/{id}/edit",UserEdit::class)->name("users.edit");
Route::get("users/{id}",UserShow::class)->name("users.show");


Route::get('/get/district/{provinceId}',[AddressController::class,'getDistrict'])->name('get.district');
Route::get('get-sub-district/{districtId}',[AddressController::class,'getMunicipality'])->name('get.municipality');
Route::get('get-ward/{municipalityId}',[AddressController::class,'getWard'])->name('get.ward');


