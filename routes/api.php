<?php

use App\Http\Controllers\API\BlogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\NewsMediaController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\NewsletterController;
use App\Http\Controllers\API\InternationalRegistrationController;
use App\Http\Controllers\API\VolunteerRegistrationController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;


Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::post('/contact', [ContactController::class, 'store']);
Route::post('/newsletter', [NewsletterController::class, 'store']);
Route::post('/register/volunteer', [VolunteerRegistrationController::class, 'store']);
Route::post('/international', [InternationalRegistrationController::class, 'store']);
Route::apiResource('blogs', App\Http\Controllers\Api\BlogController::class);
Route::apiResource('news-media', App\Http\Controllers\Api\NewsMediaController::class);
Route::apiResource('events', App\Http\Controllers\Api\EventController::class);
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

