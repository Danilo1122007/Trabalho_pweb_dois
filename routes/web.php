<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\LodgingController;
use App\Http\Controllers\GroomingController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnimalsController;


Route::get('/', [InicioController::class, 'index'])->name('inicio');
Route::get('/inicio', [InicioController::class, 'index'])->name('inicio');

/**
 * Parking
 */
Route::get('/parking', [ParkingController::class, 'index'])->name('parking.index');
Route::get('/parking/create', [ParkingController::class, 'create'])->name('parking.create');
Route::post('/parking', [ParkingController::class, 'store'])->name('parking.store');
Route::get('/parking/edit/{id}', [ParkingController::class, 'edit'])->name('parking.edit');
Route::put('/parking/update/{id}', [ParkingController::class, 'update'])->name('parking.update');
Route::post('/parking/search', [ParkingController::class, 'search'])->name('parking.search');
Route::get('/parking/search-ajax', [ParkingController::class, 'searchAjax'])->name('parking.search.ajax');//ajax criado
Route::delete('/parking/{id}', [ParkingController::class, 'destroy'])->name('parking.destroy');
Route::get('/parking/report', [ParkingController::class, 'report'])->name('parking.report');
Route::get('/parking/chart', [ParkingController::class, 'chart'])->name('parking.chart');

/**
 * Vehicle Types
 */
Route::get('/vehicle-types', [VehicleTypeController::class, 'index'])->name('vehicle-types.index');
Route::get('/vehicle-types/create', [VehicleTypeController::class, 'create'])->name('vehicle-types.create');
Route::post('/vehicle-types', [VehicleTypeController::class, 'store'])->name('vehicle-types.store');

/**
 * Grooming
 */
Route::get('/grooming', [GroomingController::class, 'index'])->name('grooming.index');
Route::get('/grooming/create', [GroomingController::class, 'create'])->name('grooming.create');
Route::post('/grooming', [GroomingController::class, 'store'])->name('grooming.store');
Route::get('/grooming/edit/{id}', [GroomingController::class, 'edit'])->name('grooming.edit');
Route::put('/grooming/update/{id}', [GroomingController::class, 'update'])->name('grooming.update');
Route::post('/grooming/search', [GroomingController::class, 'search'])->name('grooming.search');
Route::get('/grooming/search-ajax', [GroomingController::class, 'searchAjax'])->name('grooming.search.ajax');//criar ajax
Route::delete('/grooming/{id}', [GroomingController::class, 'destroy'])->name('grooming.destroy');

/**
 * Lodging
 */
Route::get('/lodging', [LodgingController::class, 'index'])->name('lodging.index');
Route::get('/lodging/create', [LodgingController::class, 'create'])->name('lodging.create');
Route::post('/lodging', [LodgingController::class, 'store'])->name('lodging.store');
Route::get('/lodging/edit/{id}', [LodgingController::class, 'edit'])->name('lodging.edit');
Route::put('/lodging/update/{id}', [LodgingController::class, 'update'])->name('lodging.update');
Route::post('/lodging/search', [LodgingController::class, 'search'])->name('lodging.search');
Route::get('/lodging/search-ajax', [LodgingController::class, 'searchAjax'])->name('lodging.search.ajax');//criar ajax
Route::delete('/lodging/{id}', [LodgingController::class, 'destroy'])->name('lodging.destroy');

/**
 * Animals
 */
Route::get('/animals', [AnimalsController::class, 'index'])->name('animals.index');
Route::get('/animals/create', [AnimalsController::class, 'create'])->name('animals.create');
Route::post('/animals', [AnimalsController::class, 'store'])->name('animals.store');
Route::get('/animals/{id}/edit', [AnimalsController::class, 'edit'])->name('animals.edit');
Route::put('/animals/{id}', [AnimalsController::class, 'update'])->name('animals.update');
Route::post('/animals/search', [AnimalsController::class, 'search'])->name('animals.search');
Route::get('/animals/search-ajax', [AnimalsController::class, 'searchAjax'])->name('animals.search.ajax');
Route::delete('/animals/{id}', [AnimalsController::class, 'destroy'])->name('animals.destroy');

/**n
 * Products
 */
// Products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::post('/products/{id}/cart', [ProductController::class, 'addToCart'])->name('products.addToCart');


/**
 * Cart
 */
Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::delete('cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::patch('cart/{id}/quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');

/**
 * Orders
 */
Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('orders/report', [OrderController::class, 'report'])->name('orders.report');
Route::get('orders/{id}', [OrderController::class, 'show'])->name('orders.show');


/**
 * Auth
 */
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

/**
 * Dashboard
 */
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
