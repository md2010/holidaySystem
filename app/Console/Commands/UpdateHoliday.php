<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class UpdateHoliday extends Command
{
    protected $signature = 'holiday:update';

    protected $description = 'Renew holiday to all users.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        User::update(['availableDays', 20]);
    }
}
