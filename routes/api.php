<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\API\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/companies', [ApiController::class, 'companies']);
Route::get('/category', [ApiController::class, 'category']);
Route::get('/company/{company}', [ApiController::class, 'company']);
Route::post('/add-company', [ApiController::class, 'addCompany']);
Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout',[AuthController::class,'logout']);
});
Route::delete('/delete-company/{id}', [ApiController::class, 'deleteCompany']);
Route::post('/update/{id}', [ApiController::class, 'updateCompany']);
