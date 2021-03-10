<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Team;
use App\Models\HolidayRequests;

class User extends Authenticatable
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
        'passwordVisible',
        'position',
        'availableDays',
        'team_id'
    ];

    protected $hidden = [
        'password'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function holidayRequests()
    {
        return $this->hasMany(HolidayRequests::class);
    }
}
