<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DepartmentController;


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

// Route::get('/test-data', function(){
//     return 'hello';
// });

Route::post('register', [UserController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {
    // Route::get('user', 'UserController@user');
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('user', [AuthController::class, 'user']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::resource('students', 'App\Http\Controllers\StudentController');

    Route::resource('departments', 'App\Http\Controllers\DepartmentController');

    // Route::get('departments', [DepartmentController::class, 'index']);
    // Route::get('departments/{id}', [DepartmentController::class, 'show']);
    // Route::post('departments', [DepartmentController::class, 'store']);
    // Route::put('departments/{id}', [DepartmentController::class, 'update']);
    // Route::delete('departments/{id}', [DepartmentController::class, 'destroy']);
    // Route::get('department', [DepartmentController::class, 'department']);
});
