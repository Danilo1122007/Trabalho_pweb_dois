<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\GroomingController;
use App\Http\Controllers\LodgingController;

Route::get('/', [InicioController::class, 'index'])->name('inicio');
Route::get('/inicio', [InicioController::class, 'index'])->name('inicio');

Route::get('/parking', [ParkingController::class, 'index'])->name('parking.index');
Route::get('/parking/create', [ParkingController::class, 'create'])->name('parking.create');
Route::post('/parking', [ParkingController::class, 'store'])->name('parking.store');
Route::get('/parking/edit/{id}', [ParkingController::class, 'edit'])->name('parking.edit');
Route::put('/parking/update/{id}', [ParkingController::class, 'update'])->name('parking.update');
Route::post('/parking/search', [ParkingController::class, 'search'])->name('parking.search');
Route::delete('/parking/{id}', [ParkingController::class, 'destroy'])->name('parking.destroy');

Route::get('/grooming', [GroomingController::class, 'index'])->name('grooming.index');
Route::get('/grooming/create', [GroomingController::class, 'create'])->name('grooming.create');
Route::post('/grooming', [GroomingController::class, 'store'])->name('grooming.store');
Route::get('/grooming/edit/{id}', [GroomingController::class, 'edit'])->name('grooming.edit');
Route::put('/grooming/update/{id}', [GroomingController::class, 'update'])->name('grooming.update');
Route::post('/grooming/search', [GroomingController::class, 'search'])->name('grooming.search');
Route::delete('/grooming/{id}', [GroomingController::class, 'destroy'])->name('grooming.destroy');

Route::get('/lodging', [LodgingController::class, 'index'])->name('lodging.index');
Route::get('/lodging/create', [LodgingController::class, 'create'])->name('lodging.create');
Route::post('/lodging', [LodgingController::class, 'store'])->name('lodging.store');
Route::get('/lodging/edit/{id}', [LodgingController::class, 'edit'])->name('lodging.edit');
Route::put('/lodging/update/{id}', [LodgingController::class, 'update'])->name('lodging.update');
Route::post('/lodging/search', [LodgingController::class, 'search'])->name('lodging.search');
Route::delete('/lodging/{id}', [LodgingController::class, 'destroy'])->name('lodging.destroy');