<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogInController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HolidayRequestController;

//get routes
Route::get('/login', [LogInController::class, 'showLogInForm'])->name('login');

Route::get('/logout', [LogInController::class, 'logOut'])->name('logout');

Route::get('/employee', 
    [EmployeeController::class, 'index'])
    ->name('employee')
    ->middleware('auth');

Route::get('/holidayRequestForm', 
    [HolidayRequestController::class, 'showHolidayRequestForm'])
    ->middleware('auth')
    ->name('showHolidayRequestForm');

Route::get('/myHolidayRequests',
    [HolidayRequestController::class, 'showHolidayRequests'])
    ->middleware('auth')
    ->name('showHolidayRequests');


//post routes
Route::post('/auth', [LogInController::class, 'validateLogIn']);

Route::post('/employee/processHolidayRequest', 
    [HolidayRequestController::class, 'processEmployeeRequest'])
    ->middleware('auth')
    ->name('processEmployeeRequest');

Route::post('/processHolidayRequestUpdate', 
    [HolidayRequestController::Class, 'processHolidayRequestUpdate'])
    ->middleware('auth')
    ->name('processHolidayRequestUpdate');
