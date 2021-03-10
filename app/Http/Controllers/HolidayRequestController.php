<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use DateTime;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\TeamRepositoryInterface;
use App\Interfaces\HolidayRequestRepositoryInterface;

class HolidayRequestController extends Controller
{
    protected $userInterface;
    protected $holidayRequestInterface;
    protected $teamInterface;

    public function __construct(
        UserRepositoryInterface $userInterface, 
        HolidayRequestRepositoryInterface $holidayRequestInterface,
        TeamRepositoryInterface $teamInterface
        )
    {
        $this->userInterface = $userInterface;
        $this->holidayRequestInterface = $holidayRequestInterface;
        $this->teamInterface = $teamInterface;
    }

    public function showHolidayRequestForm()
    {
        return view('holidayRequestForm');
    }

    public function processHolidayRequest(Request $request) 
    {
        $fromDate = new Datetime($request->only('fromDate')["fromDate"]);
        $toDate = new DateTime($request->only('toDate')["toDate"]);
        $availableDays = $this->userInterface->getAvailableDays();       
        $days = ($fromDate->diff($toDate))->d;
        
        if ($days <= $availableDays) {
            $this->userInterface->updateAvailableDays($days);
            $this->holidayRequestInterface->store($fromDate, $toDate);
            return Redirect::to('/'.$this->userInterface->resolveUser());          
        } else {
            return Redirect::back()->withErrors(['You do not have enough available days left!']);
        }
    }

    public function showHolidayRequests()
    {
        $position = $this->userInterface->resolveUser();

        if($position == 'admin') {
            //
        } else {
            $requests = $this->holidayRequestInterface->getHolidayRequests();
            return view('showHolidayRequests-employeeView')->with('requests', $requests);
        }     
    }

    public function showTeamsHolidayRequests()
    {
        $IDs = $this->teamInterface->getTeamMembersIDs();
        $requests = $this->holidayRequestInterface->getTeamsHolidayRequests($IDs);
        return view('teamsHolidayRequests')->with('requests', $requests);
    }

    public function processHolidayRequestUpdate(Request $request)
    {
        $this->holidayRequestInterface->updateDate($request);
        return Redirect::to('/myHolidayRequests');
    }

    public function processHolidayRequestDecision(Request $request)
    {
        $action = ($request->only('button')['button'] == "Approve") ? $decision = 'APPROVED' : $decision = 'REJECTED';
        $position = $this->userInterface->resolveUser();
        $requestID = $request->only('id')["id"];
        $this->holidayRequestInterface->concludeHolidayRequest($requestID, $position, $decision);

        return Redirect::to('/teamsHolidayRequests');
    }
    
}
