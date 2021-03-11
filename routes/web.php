<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogInController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ManagerLeaderController;
use App\Http\Controllers\HolidayRequestController;
use App\Http\Controllers\AdminController;

//get routes
Route::get('/login', [LogInController::class, 'showLogInForm'])
->name('login');

Route::get('/logout', [LogInController::class, 'logOut'])
->name('logout');


//post routes
Route::post('/auth', [LogInController::class, 'validateLogIn']);


//middleware group
Route::middleware(['auth'])->group(function () {
    Route::get('/employee', [EmployeeController::class, 'index'])
    ->name('employee');

    Route::get('/holidayRequestForm', 
    [HolidayRequestController::class, 'showHolidayRequestForm'])
    ->name('showHolidayRequestForm');

    Route::get('/myHolidayRequests',
    [HolidayRequestController::class, 'showHolidayRequests'])
    ->name('showHolidayRequests');

    Route::get('/teamLeader', 
    [ManagerLeaderController::class, 'index'])
    ->name('teamLeader');

    Route::get('/teamInfo/{team_id}', 
    [ManagerLeaderController::class, 'showTeamInfo'])
    ->name('showTeamInfo');

    Route::get('/team/{id}/members',
    [ManagerLeaderController::class, 'showTeamMembers'])
    ->name('showTeamMembers');

    Route::get('/team/{$id}/teamsHolidayRequests', 
    [HolidayRequestController::class, 'showTeamsHolidayRequests'])
    ->name('showTeamsHolidayRequests');

    Route::get('/projectManager', 
    [ManagerLeaderController::class, 'index'])
    ->name('projectManager');

    Route::get('/admin', 
    [AdminController::class, 'index'])
    ->name('admin');

    Route::get('/admin/teamLeaders', 
    [AdminController::class, 'showTeamLeaders'])
    ->name('showTeamLeaders');

    Route::get('/admin/projectManagers', 
    [AdminController::class, 'showProjectManagers'])
    ->name('showProjectManagers');

    Route::get('/admin/team/{id}/members', 
    [ManagerLeaderController::class, 'showTeamMembers'])
    ->name('showTeamMembersAdmin');

    Route::get('/admin/teams', [AdminController::class, 'showTeams'])
    ->name('showTeams');

    Route::get('/admin/holidayRequests', [HolidayRequestController::class, 'showHolidayRequests'])
    ->name('showHolidayRequestsAdmin');

    Route::get('/admin/holidayRequests/unresolved', [AdminController::class, 'showHolidayRequestsForAdmin'])
    ->name('showHolidayRequestsForAdmin');
        

    //post routes
    Route::post('/processHolidayRequest', 
    [HolidayRequestController::class, 'processHolidayRequest'])
    ->name('processHolidayRequest');

    Route::post('/processHolidayRequestUpdate', 
    [HolidayRequestController::Class, 'processHolidayRequestUpdate'])
    ->name('processHolidayRequestUpdate');

    Route::post('/processHolidayRequestDecision/{id}',
    [HolidayRequestController::class, 'processHolidayRequestDecision'])
    ->name('processHolidayRequestDecision');

    Route::post('/admin/processButtonActionUser/{user_id}', 
    [AdminController::class, 'processButtonActionUser'])
    ->name('processButtonActionUser');

    Route::post('/admin/processButtonActionTeam/{team_id}', 
    [AdminController::class, 'processButtonActionTeam'])
    ->name('processButtonActionTeam');

});