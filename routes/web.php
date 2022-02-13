<?php
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
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
Route::get('/', [CompanyController::class, 'index']);
Route::get('/add-company', [CompanyController::class, 'addCompany']);
Route::post('/store', [CompanyController::class,'storeCompany']);
Route::get('/company/{company}', [CompanyController::class, 'showCompany']);
Route::get('/delete/company/{company}', [CompanyController::class, 'deleteCompany']);
Route::get('/update/company/{company}', [CompanyController::class, 'updateCompany']);
Route::post('/update/{company}', [CompanyController::class, 'storeUpdate']);
Route::get('/import', [CompanyController::class, 'importCompany']);
Route::post('/preview', [CompanyController::class, 'processImport']);
Route::post('/', [CompanyController::class, 'importAdd']);
Route::post('/company/{company}/comment', [CommentController::class,'create']);

Route::get('/add-category', [CategoryController::class, 'addCategory']);
Route::post('/create-category', [CategoryController::class, 'createCategory']);
Route::get('/show-categories', [CategoryController::class, 'showCompanies']);

Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/add-product', [ProductController::class, 'addProduct']);
Route::post('/create-product', [ProductController::class,'createProduct']);
Route::get('/show-products', [ProductController::class, 'showProducts']);
Route::post('/add-orders', [OrderController::class, 'addOrders']);
