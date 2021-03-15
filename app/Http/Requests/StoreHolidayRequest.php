<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use DateTime;

class StoreHolidayRequest extends FormRequest
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function authorize()
    {
         return true;
    }
    
    public function rules()
    {
        return [
            'fromDate' => 'required',
            'toDate' => 'required|after:fromDate'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $user = $this->userRepository->getByID(Auth::id());
            $availableDays = $user->availableDays;   
            $fromDate = new Datetime($this->validated()["fromDate"]);
            $toDate = new DateTime($this->validated()["toDate"]); 
            $days = ($fromDate->diff($toDate))->d;

            if ($days >= $availableDays) {
                $validator->errors()->add('toDate', 'You do not have enough available days left!');
            }
        });
        
    }
}
