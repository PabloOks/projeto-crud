<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
  Route::apiResource('users', UserController::class);
  Route::apiResource('tasks', TaskController::class);
  Route::patch('tasks/{task}/change-status', [TaskController::class, 'changeStatus']);
  Route::post('tasks/{task}/delegate', [TaskController::class, 'delegateMembers']);

  Route::post('logout', [LoginController::class, 'logout']);
});
