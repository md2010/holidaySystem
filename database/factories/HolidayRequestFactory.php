<?php

namespace Database\Factories;

use App\Models\HolidayRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class HolidayRequestFactory extends Factory
{
    protected $model = HolidayRequest::class;

    public function definition()
    {
        $start = $this->faker->date;
        return [
            'fromDate' => $start,
            'toDate' => $this->faker->dateTimeBetween($start, '+6 days')
        ];
    }
}
