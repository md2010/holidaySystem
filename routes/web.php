<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogInController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TeamLeaderController;
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

Route::get('/teamLeader', 
    [TeamLeaderController::class, 'index'])
    ->name('teamLeader')
    ->middleware('auth');

Route::get('/teamLeader/members',
    [TeamLeaderController::class, 'showTeamMembers'])
    ->name('showTeamMembers')
    ->middleware('auth');

Route::get('/teamsHolidayRequests', 
    [HolidayRequestController::class, 'showTeamsHolidayRequests'])
    ->name('showTeamsHolidayRequests')
    ->middleware('auth');



//post routes
Route::post('/auth', [LogInController::class, 'validateLogIn']);

Route::post('/processHolidayRequest', 
    [HolidayRequestController::class, 'processHolidayRequest'])
    ->middleware('auth')
    ->name('processHolidayRequest');

Route::post('/processHolidayRequestUpdate', 
    [HolidayRequestController::Class, 'processHolidayRequestUpdate'])
    ->middleware('auth')
    ->name('processHolidayRequestUpdate');

Route::post('/processHolidayRequestDecision',
    [HolidayRequestController::class, 'processHolidayRequestDecision'])
    ->middleware('auth')
    ->name('processHolidayRequestDecision');
