<?php

use App\Http\Controllers\AccessController;
use App\Http\Controllers\CheckingController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\CompleteController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\MasterTypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceAdvisorController;
use App\Models\ServiceAdvisor;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/pre-check', function () {
    return view('pdf.precheck');
});

Route::get('/check-pdf/{id}', [CheckingController::class, 'pdf'])->name('download');
Route::get('/check-pdf/post/{id}', [CheckingController::class, 'pdf_post'])->name('download.standart_post');
Route::get('/complete-pre/pdf/{id}', [CompleteController::class, 'pdf'])->name('download.complete_pre');
Route::get('/complete-post/pdf/{id}', [CompleteController::class, 'pdf_post'])->name('download.complete_post');

Route::get('/view/standart-pdf/{id}', [CheckingController::class, 'view_pdf'])->name('pdf.standart_pre');


Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('sadmin.index');
    });
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Clients or Admin
    Route::get('/clients', [ClientsController::class, 'index'])->name('client');
    Route::get('/client/data', [ClientsController::class, 'data'])->name('client.data');
    Route::get('/client/edit/{id}', [ClientsController::class, 'edit'])->name('client.edit');
    Route::post('/clients', [ClientsController::class, 'store'])->name('client.store');
    Route::post('/client/update', [ClientsController::class, 'update'])->name('client.update');
    Route::get('/client/destroy/{id}', [ClientsController::class, 'destroy'])->name('client.destroy');
    Route::get('/client/employee/{id}', [ClientsController::class, 'employee'])->name('client.employee');
    Route::get('/client/employee/data/{id}', [ClientsController::class, 'employee_data'])->name('client.employee.data');
    Route::get('/client/download', [ClientsController::class, 'download_bengkel'])->name('client.download');

    Route::get('/access', [AccessController::class, 'index'])->name('access');
    Route::get('/access/data', [AccessController::class, 'data'])->name('access.data');
    Route::get('/access/show/{id}', [AccessController::class, 'show'])->name('access.show');
    Route::post('/access/update', [AccessController::class, 'update'])->name('access.update');

    // Employees
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('/employee/show/{id}', [EmployeeController::class, 'show'])->name('employee.show');
    Route::get('/employee/data', [EmployeeController::class, 'data'])->name('employee.data');
    Route::post('/employee/store', [EmployeeController::class, 'store'])->name('employee.store');
    Route::post('/employee/update', [EmployeeController::class, 'update'])->name('employee.update');
    Route::get('/employee/destroy/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
    Route::get('/employee/download', [EmployeeController::class, 'download'])->name('employee.download');

    // Types
    Route::get('/types', [MasterTypeController::class, 'index'])->name('type.index');
    Route::get('/type/data', [MasterTypeController::class, 'data'])->name('type.data');
    Route::get('/type/edit/{id}', [MasterTypeController::class, 'show'])->name('type.show');
    Route::get('/type/destroy/{id}', [MasterTypeController::class, 'destroy'])->name('type.destroy');
    Route::post('/type/update', [MasterTypeController::class, 'update'])->name('type.update');
    Route::post('/type/store', [MasterTypeController::class, 'store'])->name('type.store');

    // Standart Checking
    Route::get('/checking/standart', [CheckingController::class, 'index'])->name('checking.index');
    Route::get('/checking/standart/create', [CheckingController::class, 'create'])->name('checking.create');
    Route::get('/checking/data', [CheckingController::class, 'data'])->name('checking.data');
    Route::get('/checking/edit/{id}', [CheckingController::class, 'show'])->name('checking.show');
    Route::post('/checkings', [CheckingController::class, 'store'])->name('checking.store');
    Route::post('/checking/update', [CheckingController::class, 'update'])->name('checking.update');
    Route::get('/checking/destroy/{id}', [CheckingController::class, 'destroy'])->name('checking.destroy');
    Route::get('/checking/image', [CheckingController::class, 'image_data'])->name('checking.image_data');
    Route::get('/checking/image/post', [CheckingController::class, 'image_post_data'])->name('checking.image_post_data');
    Route::post('/checking/image', [CheckingController::class, 'image'])->name('checking.image');
    Route::post('/checking/image/update', [CheckingController::class, 'image_update'])->name('checking.image_update');
    Route::get('/checking/image/destroy/{id}', [CheckingController::class, 'image_destroy'])->name('checking.image_destroy');
    Route::get('/checking/download', [CheckingController::class, 'download'])->name('checking.download');

    // Standart Post Check
    Route::get('/checking/pro/create/post/{id}', [CheckingController::class, 'create_post'])->name('checking.create_post');
    Route::get('/checking/pro/view/post/{id}', [CheckingController::class, 'show_post'])->name('checking.show_post');
    Route::post('/checkings/post', [CheckingController::class, 'store_post'])->name('checking.store_post');

    // Advisors
    Route::get('/advisor', [ServiceAdvisorController::class, 'index'])->name('advisor.index');
    Route::get('/advisor/data', [ServiceAdvisorController::class, 'data'])->name('advisor.data');
    Route::post('/advisor/store', [ServiceAdvisorController::class, 'store'])->name('advisor.store');
    Route::get('/advisor/show/{id}', [ServiceAdvisorController::class, 'show'])->name('advisor.show');
    Route::post('/advisor/update', [ServiceAdvisorController::class, 'update'])->name('advisor.update');
    Route::get('/advisor/destroy/{id}', [ServiceAdvisorController::class, 'destroy'])->name('advisor.destroy');

    // Master
    Route::get('/master/standart', [MasterController::class, 'index'])->name('master.index');
    Route::get('/master/data', [MasterController::class, 'data'])->name('master.data');
    Route::post('/master/store', [MasterController::class, 'store'])->name('master.store');
    Route::get('/master/destroy/{id}', [MasterController::class, 'destroy'])->name('master.destroy');
    Route::get('/master/edit/{id}', [MasterController::class, 'edit'])->name('master.edit');
    Route::post('/master/update', [MasterController::class, 'update'])->name('advisor.update');

    Route::get('/master/complete', [MasterController::class, 'index'])->name('master.index');

    // Complete Checking
    Route::get('/checking/complete', [CompleteController::class, 'index'])->name('complete.index');
    Route::get('/complete/data', [CompleteController::class, 'data'])->name('complete.data');
    Route::post('/complete/store', [CompleteController::class, 'store'])->name('complete.store');
    Route::get('/complete/edit/{id}', [CompleteController::class, 'show'])->name('complete.show');
    Route::post('/complete/update', [CompleteController::class, 'update'])->name('complete.update');
    Route::get('/complete/image', [CompleteController::class, 'image_data'])->name('complete.image_data');
    Route::post('/complete/image', [CompleteController::class, 'image'])->name('complete.image');
    Route::post('/complete/image/update', [CompleteController::class, 'image_update'])->name('complete.image_update');
    Route::get('/complete/image/destroy/{id}', [CompleteController::class, 'image_destroy'])->name('complete.image_destroy');
    
    // Complete Post Check
    Route::get('/complete/pro/create/post/{id}', [CompleteController::class, 'create_post'])->name('complete.create_post');
    Route::get('/complete/pro/view/post/{id}', [CompleteController::class, 'show_post'])->name('complete.show_post');
    Route::post('/completes/post', [CompleteController::class, 'store_post'])->name('complete.store_post');

    Route::get('/get-kuota-and-total', [ClientsController::class, 'kuota'])->name('clients.kuota');
});

require __DIR__ . '/auth.php';
