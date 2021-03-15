<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreOrUpdateTeamRequest;
use App\Http\Requests\StoreOrUpdateUserRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\TeamRepositoryInterface;
use App\Interfaces\HolidayRequestRepositoryInterface;

class AdminController extends Controller
{
    protected $userRepository;
    protected $teamRepository;
    protected $holidayRequestRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        TeamRepositoryInterface $teamRepository,
        HolidayRequestRepositoryInterface $holidayRequestRepository
    ) {
        $this->userRepository = $userRepository;
        $this->teamRepository = $teamRepository;
        $this->holidayRequestRepository = $holidayRequestRepository;
    }

    public function index()
    {
        $admin = $this->userRepository->getByID(Auth::id());
        return view('admin')->with('value', $admin);
    }

    public function showTeamLeaders()
    {
        $leaders = $this->userRepository->getTeamLeaders();
        return view('showManagersLeaders')->with('leader', $leaders);
    }

    public function showProjectManagers()
    {
        $managers = $this->userRepository->getProjectManagers();
        return view('showManagersLeaders')->with('leader', $managers);
    }

    public function showTeams()
    {
        $teams = $this->teamRepository->getAll();
        return view('teamInfo')->with('team', $teams);
    }

    public function processButtonActionUser(StoreOrUpdateUserRequest $request, $user_id)
    {
        $validated = $request->validated();
        $action = $request->only('button')['button'];
        if($action == 'Delete') {
            $this->userRepository->delete($request->only('id')['id']);
        } else {
            $data = $request->except(['_token', 'button']);
            $this->userRepository->update($data);
        }
        return Redirect::back();

    }

    public function processButtonActionTeam(StoreOrUpdateTeamRequest $request, $team_id)
    {
        $action = $request->only('button')['button'];
        if($action == 'Delete') {
            $this->teamRepository->delete( $request->only('data')['data'][0]);
        } else {
            $data = $request->except(['_token', 'button']);
            if(! $this->teamRepository->update($data)) {
                Redirect::back()->withErrors(['Team Leader ID or Project Manager ID not valid!']);
            }          
        }
        return Redirect::back();
    }

    public function showNewEmployeeForm()
    {
        return view('newEmployeeForm');
    }

    public function addNewEmployee(Request $request)
    {
        $data = $request->except(['_token', 'button']);
        $this->userRepository->store($data);
        return redirect()->route('admin');
    }

    public function showNewTeamForm()
    {
        return view('newTeamForm');
    }

    public function addNewTeam(StoreOrUpdateTeamRequest $request)
    {
        $validated = $request->validated();       
        $this->teamRepository->store($validated);
        return redirect()->route('admin');
    }

}
