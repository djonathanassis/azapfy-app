<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthenticatedController;
use App\Http\Controllers\Auth\RegisteredController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('v1')->group(function () {
    Route::post('/login', [AuthenticatedController::class, 'login']);
    Route::post('/register', RegisteredController::class);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::apiResource('/invoices', InvoiceController::class);
        Route::delete('/logout', [AuthenticatedController::class, 'logout']);
    });
});

