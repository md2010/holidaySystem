<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class HolidayRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fromDate',
        'toDate',
        'status',
        'teamLeaderApproval',
        'projectManagerApproval'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
