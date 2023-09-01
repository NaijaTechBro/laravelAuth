<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\PasswordResetTokensController;

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


// Public Routes
Route::post('/register', [RegistrationController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/forgotPassword', [PasswordResetTokensController::class, 'forgotPassword']);
Route::post('/resetPassword/{token}', [PasswordResetTokensController::class, 'resetPassword']);

Route::post('/sendVerificationEmail', [VerifyEmailController::class, 'sendEmailVerification']);
Route::post('/verifyEmail/{token}', [VerifyEmailController::class, 'verifyAccount']);


// Protected Routes
Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/loggeduser', [AuthController::class, 'logged_user']);
    Route::post('/changepassword', [UserController::class, 'change_password']);
});