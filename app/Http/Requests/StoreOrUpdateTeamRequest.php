<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\UserRepositoryInterface;

class StoreOrUpdateTeamRequest extends FormRequest
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function authorize()
    {
        if($this->userRepository->getByID(Auth::id())->position == 'admin') {
            return true;
        } 
        return false;
    }

    public function rules()
    {
        $projectManagersIDs = $this->userRepository
            ->getProjectManagers()
            ->pluck('id');
        $teamLeadersIDs = $this->userRepository
            ->getTeamLeaders()
            ->pluck('id');

        return [
            'name' => 'nullable|unique:teams',
            'projectManagerID' => [
                'required',
                Rule::in($projectManagersIDs),
            ],
            'teamLeaderID' => [
                'required',
                Rule::in($teamLeadersIDs),
            ],
        ];
    }

    public function attributes()
    {
        return [
            'projectManagerID' => 'Project manager ID',
            'teamLeaderID' => 'Team leader ID',
        ];
    }

}
