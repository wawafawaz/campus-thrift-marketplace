<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminTransactionController;
use App\Http\Controllers\AdminReportController;

Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

/* USERS */
Route::get('/admin/users', [AdminUserController::class, 'index']);
Route::post('/admin/users/{id}/active', [AdminUserController::class, 'setActive']);
Route::post('/admin/users/{id}/restrict', [AdminUserController::class, 'restrict']);
Route::post('/admin/users/{id}/ban', [AdminUserController::class, 'ban']);

/* PRODUCTS */
Route::get('/admin/products', [AdminProductController::class, 'index']);
Route::post('/admin/products', [AdminProductController::class, 'store']);
Route::post('/admin/products/{id}/approve', [AdminProductController::class, 'approve']);
Route::post('/admin/products/{id}/reject', [AdminProductController::class, 'reject']);
Route::delete('/admin/products/{id}', [AdminProductController::class, 'destroy']);

/* TRANSACTIONS */
Route::get('/admin/transactions', [AdminTransactionController::class, 'index']);

/* REPORTS */
Route::get('/admin/reports', [AdminReportController::class, 'index']);
Route::post('/admin/reports/{id}/resolve', [AdminReportController::class, 'resolve']);