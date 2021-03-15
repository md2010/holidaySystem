<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreHolidayRequest;
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

    public function processHolidayRequest(StoreHolidayRequest $request) 
    {
        $validated = $request->validated();
        $fromDate = new Datetime($this->validated()["fromDate"]);
        $toDate = new DateTime($this->validated()["toDate"]); 
        $days = ($fromDate->diff($toDate))->d;
        $user = $this->userRepository->getByID(Auth::id());
        $availableDays = $user->availableDays; 
        $this->userRepository->update(['id' => Auth::id(), 'availableDays' => ($availableDays - $days)]);
        $this->holidayRequestRepository->store($fromDate, $toDate);
        return redirect()->route($user->position);           
      
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
