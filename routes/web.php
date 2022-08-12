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
Route::get('customers/export/mapping',[\App\Http\Controllers\CustomersController::class,'export_mapping'])->name('customers.export-mapping');
Route::get('customers/export/mapping',[\App\Http\Controllers\CustomersController::class,'export_styling'])->name('customers.export-styling');
Route::get('customers/export/autosize',[\App\Http\Controllers\CustomersController::class,'export_autosize'])->name('customers.export-autosize');
Route::get('customers/export/dateformat',[\App\Http\Controllers\CustomersController::class,'export_dateformat'])->name('customers.export-dateformat');

Route::post('customers/import',[\App\Http\Controllers\CustomersController::class,'import'])->name('customers.import');
Route::post('customers/import/large',[\App\Http\Controllers\CustomersController::class,'import_large'])->name('customers.import-large');
Route::post('customers/import/relationship',[\App\Http\Controllers\CustomersController::class,'import_relationship'])->name('customers.import-relationship');
Route::post('customers/import/dateformat',[\App\Http\Controllers\CustomersController::class,'import_dateformat'])->name('customers.import-dateformat');
Route::post('customers/import/errors',[\App\Http\Controllers\CustomersController::class,'import_errors'])->name('customers.import-errors');