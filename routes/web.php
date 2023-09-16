<?php

use App\Http\Controllers\ClientsController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('sadmin.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/clients', [ClientsController::class, 'index'])->name('client');
Route::get('/client/data', [ClientsController::class, 'data'])->name('client.data');
Route::get('/client/edit/{id}', [ClientsController::class, 'edit'])->name('client.edit');
Route::post('/clients', [ClientsController::class, 'store'])->name('client.store');
Route::post('/client/update', [ClientsController::class, 'update'])->name('client.update');
Route::get('/client/destroy/{id}', [ClientsController::class, 'destroy'])->name('client.destroy');
Route::get('/client/employee/{id}', [ClientsController::class, 'employee'])->name('client.employee');
Route::get('/client/employee/data/{id}', [ClientsController::class, 'employee_data'])->name('client.employee.data');

Route::get('/employees', [EmployeeController::class, 'index'])->name('employee.index');
Route::get('/employee/show/{id}', [EmployeeController::class, 'show'])->name('employee.show');
Route::get('/employee/data', [EmployeeController::class, 'data'])->name('employee.data');
Route::post('/employee/update', [EmployeeController::class, 'update'])->name('employee.update');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
