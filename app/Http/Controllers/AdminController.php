<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\TeamRepositoryInterface;
use App\Interfaces\HolidayRequestRepositoryInterface;

class AdminController extends Controller
{
    protected $userInterface;
    protected $teamInterface;
    protected $holidayRequestInterface;

    public function __construct(
        UserRepositoryInterface $userInterface,
        TeamRepositoryInterface $teamInterface,
        HolidayRequestRepositoryInterface $holidayRequestInterface
    ) {
        $this->userInterface = $userInterface;
        $this->teamInterface = $teamInterface;
        $this->holidayRequestInterface = $holidayRequestInterface;
    }

    public function index()
    {
        $admin = $this->userInterface->getByID(Auth::id());
        return view('admin')->with('value', $admin);
    }

    public function showTeamLeaders()
    {
        $leaders = $this->userInterface->getTeamLeaders();
        return view('showManagersLeaders')->with('leader', $leaders);
    }

    public function showProjectManagers()
    {
        $managers = $this->userInterface->getProjectManagers();
        return view('showManagersLeaders')->with('leader', $managers);
    }

    public function showTeams()
    {
        $teams = $this->teamInterface->getAll();
        return view('teamInfo')->with('team', $teams);
    }

    public function processButtonActionUser(Request $request, $user_id)
    {
        $action = $request->only('button')['button'];
        if($action == 'Delete') {
            $this->userInterface->delete($request->only('data')['data'][0]);
        } else {
            $data = $request->input();
            $this->userInterface->update($data);
        }
        return Redirect::back();

    }

    public function processButtonActionTeam(Request $request, $team_id)
    {
        $action = $request->only('button')['button'];
        if($action == 'Delete') {
            $this->teamInterface->delete( $request->only('data')['data'][0]);
        } else {
            $data = $request->input();
            if(! $this->teamInterface->update($data)) {
                Redirect::back()->withErrors(['Team Leader ID or Project Manager ID not valid!']);
            }          
        }
        return Redirect::back();
    }

    public function showHolidayRequestsForAdmin()
    {
        $IDs = $this->userInterface->getLeaderManagerIDs();
        $requests = $this->holidayRequestInterface->getUnresolvedForAdmin($IDs);
        return view('holidayRequestsForAdmin')->with('requests', $requests);
    }

}
