<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    //public $preserveKeys = true;

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'passwordVisible' => $this->passwordVisible,
            'position' => $this->position,
            'availableDays' => $this->availableDays,
            'team_id' => $this->team_id
        ];
    }
}
