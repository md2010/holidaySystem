<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Team extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name',
        'teamLeaderID',
        'projectManagerID'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

}
