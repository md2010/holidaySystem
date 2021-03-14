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
    protected $userRepository;
    protected $holidayRequestRepository;
    protected $teamRepository;

    public function __construct(
        UserRepositoryInterface $userRepository, 
        HolidayRequestRepositoryInterface $holidayRequestRepository,
        TeamRepositoryInterface $teamRepository
    ) {
        $this->userRepository = $userRepository;
        $this->holidayRequestRepository = $holidayRequestRepository;
        $this->teamRepository = $teamRepository;
    }

    public function showHolidayRequestForm()
    {
        return view('holidayRequestForm');
    }

    public function processHolidayRequest(Request $request) //validate
    {
        $fromDate = new Datetime($request->only('fromDate')["fromDate"]);
        $toDate = new DateTime($request->only('toDate')["toDate"]);

        $user = $this->userRepository->getByID(Auth::id());
        $availableDays = $user->availableDays;       
        $days = ($fromDate->diff($toDate))->d;
        
        if ($days <= $availableDays) {
            $this->userRepository->update(['id' => Auth::id(), 'availableDays' => ($availableDays - $days)]);
            $this->holidayRequestRepository->store($fromDate, $toDate);
            return redirect()->route($user->position);           
        } else {
            return Redirect::back()->withErrors(['You do not have enough available days left!']);
        }
    }

    public function showHolidayRequests()
    {
        $user = $this->userRepository->getByID(Auth::id());

        if($user->position == 'admin') {
            $requests = $this->holidayRequestRepository->getAll();
            return view('holidayRequestsAdmin')->with('requests', $requests);
        } else {
            $requests = $this->holidayRequestRepository->getByUserID([$user->id]);
            return view('showHolidayRequests-employeeView')->with('requests', $requests);
        }     
    }

    public function showHolidayRequestsForAdmin()
    {
        $IDs = $this->userRepository->getLeaderManagerIDs();
        $requests = $this->holidayRequestRepository->getByUserID($IDs);
        $requests = $requests->where('status', 'sent');
        return view('holidayRequestsForAdmin')->with('requests', $requests);
    }

    public function showTeamsHolidayRequests($team_id)
    {
        $IDs = $this->teamRepository->getTeamMembersIDs($team_id);
        $requests = $this->holidayRequestRepository->getByUserID($IDs);
        return view('teamsHolidayRequests')->with('requests', $requests);
    }

    public function processHolidayRequestDecision(Request $request, $requestID)
    {
        $decision = ($request->only('button')['button'] == "Approve") ? 'APPROVED' : 'REJECTED';
        $user = $this->userRepository->getByID(Auth::id());
        $position = $user->position;
        $this->holidayRequestRepository->concludeHolidayRequest($requestID, $position, $decision);

        return Redirect::back();
    }
    
}
