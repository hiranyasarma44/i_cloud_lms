<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BulkLedgerController;
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

Route::get('/', [BulkLedgerController::class, 'index'])->name('get.bulk.ledger');
Route::post('/', [BulkLedgerController::class, 'upload'])->name('post.bulk.ledger');
