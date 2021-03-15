<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\UserRepositoryInterface;

class StoreOrUpdateUserRequest extends FormRequest
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
        return [
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|string',
            'password' => 'required',
            'team_id' => 'required|exists:teams,id',
            'availableDays' => 'required'
        ];
    }
}
