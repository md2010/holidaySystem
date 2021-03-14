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

    Route::get('/holiday-request-form', 
    [HolidayRequestController::class, 'showHolidayRequestForm'])
    ->name('holiday-request-form');

    Route::get('/my-holiday-requests',
    [HolidayRequestController::class, 'showHolidayRequests'])
    ->name('holiday-requests');

    Route::get('/team-leader', 
    [ManagerLeaderController::class, 'index'])
    ->name('teamLeader');

    Route::get('/team/{id}/teams-holiday-requests', 
    [HolidayRequestController::class, 'showTeamsHolidayRequests'])
    ->name('showTeamsHolidayRequests');   //error 404 ?????

    Route::get('/team-info/{team_id}', 
    [ManagerLeaderController::class, 'showTeamInfo'])
    ->name('showTeamInfo');

    Route::get('/team/{id}/members',
    [ManagerLeaderController::class, 'showTeamMembers'])
    ->name('showTeamMembers');

    Route::get('/project-manager', 
    [ManagerLeaderController::class, 'index'])
    ->name('projectManager');

    Route::get('/admin', 
    [AdminController::class, 'index'])
    ->name('admin');

    Route::get('/admin/team-leaders', 
    [AdminController::class, 'showTeamLeaders'])
    ->name('showTeamLeaders');

    Route::get('/admin/project-managers', 
    [AdminController::class, 'showProjectManagers'])
    ->name('showProjectManagers');

    Route::get('/admin/team/{id}/members', 
    [ManagerLeaderController::class, 'showTeamMembers'])
    ->name('showTeamMembersAdmin');

    Route::get('/admin/teams', [AdminController::class, 'showTeams'])
    ->name('showTeams');

    Route::get('/admin/holiday-requests/unresolved', [HolidayRequestController::class, 'showHolidayRequestsForAdmin'])
    ->name('showHolidayRequestsForAdmin');

    Route::get('/admin/new-employee-form',
    [AdminController::class, 'showNewEmployeeForm'])
    ->name('showNewEmployeeForm');
        

    //post routes
    Route::post('/process-holiday-request', 
    [HolidayRequestController::class, 'processHolidayRequest'])
    ->name('processHolidayRequest');

    Route::post('/process-holiday-request-update', 
    [HolidayRequestController::Class, 'processHolidayRequestUpdate'])
    ->name('processHolidayRequestUpdate');

    Route::post('/process-holiday-request-decision/{id}',
    [HolidayRequestController::class, 'processHolidayRequestDecision'])
    ->name('processHolidayRequestDecision');

    Route::post('/admin/process-button-action-user/{user_id}', 
    [AdminController::class, 'processButtonActionUser'])
    ->name('processButtonActionUser');

    Route::post('/admin/process-button-action-team/{team_id}', 
    [AdminController::class, 'processButtonActionTeam'])
    ->name('processButtonActionTeam');

    Route::post('/admin/add-new-employee', 
    [AdminController::class, 'addNewEmployee'])
    ->name('addNewEmployee');

});