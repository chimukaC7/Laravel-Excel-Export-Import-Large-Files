<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('export', [HomeController::class, 'export'])->name('export');
Route::post('import', [HomeController::class, 'import'])->name('import');

Route::get('customer',[\App\Http\Controllers\CustomersController::class, 'index']);
Route::get('customers/export',[\App\Http\Controllers\CustomersController::class,'export'])->name('customers.export');
Route::get('customers/export/view',[\App\Http\Controllers\CustomersController::class,'export_view'])->name('customers.export-view');
Route::get('customers/export/store',[\App\Http\Controllers\CustomersController::class,'export_store'])->name('customers.export-store');
Route::get('customers/export/format/{format}',[\App\Http\Controllers\CustomersController::class,'export_format'])->name('customers.export-format');
Route::get('customers/export/sheets',[\App\Http\Controllers\CustomersController::class,'export_sheets'])->name('customers.export-sheets');
Route::get('customers/export/heading',[\App\Http\Controllers\CustomersController::class,'export_heading'])->name('customers.export-heading');