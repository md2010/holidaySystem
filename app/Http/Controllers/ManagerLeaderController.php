<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\TeamRepositoryInterface;

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

    public function index()
    {
        $user = $this->userRepository->getByID(Auth::id());  
        return view('Manager&Leader')->with('value', $user);
    }

    public function showTeamMembers($team_id)
    {          
        $members = $this->teamRepository->getTeamMembers($team_id);      
        return view('showTeamMembers')->with('member', $members);
    }

    public function showTeamInfo($team_id)
    {
        $teamInfo = $this->teamRepository->getByID($team_id);
        return view('teamInfo')->with('team', array($teamInfo));
    }

}
