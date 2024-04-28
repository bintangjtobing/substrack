<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FinancialReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use App\Models\RoomCustomerTransaction;
use Illuminate\Support\Facades\Route;
use App\Models\Room;
use App\Models\Transaction;
use App\Models\FinancialReport;
use Illuminate\Support\Facades\DB;
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

Route::resource('/', DashboardController::class);

Route::resource('customers', CustomerController::class);
Route::resource('suppliers', SupplierController::class);
Route::resource('transactions', TransactionController::class);
Route::resource('products', ProductController::class);
Route::resource('rooms', RoomController::class);
Route::get('/rooms/{room}', [RoomController::class,'detail'])->name('rooms.detail');
Route::resource('financial-reports', FinancialReportController::class);
Route::get('/financial-reports/pdf', [FinancialReportController::class, 'generatePDF']);
Route::get('/reset-data', function(){
    DB::statement('SET FOREIGN_KEY_CHECKS=0');
    Room::truncate();
    Transaction::truncate();
    FinancialReport::truncate();
    RoomCustomerTransaction::truncate();
    DB::statement('SET FOREIGN_KEY_CHECKS=1');

    // Mengembalikan pesan sukses
    return redirect()->back()->with('success', 'Data has been reset successfully.');
});