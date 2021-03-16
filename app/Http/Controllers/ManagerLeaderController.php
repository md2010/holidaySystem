<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\TeamRepositoryInterface;
use App\Http\Resources\UserResource;

class ManagerLeaderController extends Controller
{
    protected $userRepository;
    protected $teamRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        TeamRepositoryInterface $teamRepository
    ) {
        $this->userRepository = $userRepository;
        $this->teamRepository = $teamRepository;
    }

    public function index(Request $request)
    {
        $user = new UserResource($this->userRepository->getByID(Auth::id()));  
        return view('Manager&Leader')->with('value', $user->toArray($request));
    }

    public function showTeamMembers(Request $request, $team_id)
    {          
        $members = UserResource::collection($this->userRepository->getUsersInTeam($team_id));      
        return view('showTeamMembers')->with('member', $members->toArray($request));
    }

    public function showTeamInfo($team_id)
    {
        $teamInfo = $this->teamRepository->getByID($team_id);
        return view('teamInfo')->with('team', array($teamInfo));
    }

}
