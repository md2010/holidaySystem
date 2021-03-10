<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Team;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $admin = User::factory()->create([
            'position' => 'admin'
        ]);
       
        for($i = 1; $i <= 3; $i++) {  //tim ima project managera i leadera
            $leader = User::factory()->create([
                'position' => 'teamLeader',
                'team_id' => $i 
            ]);
            $manager = User::factory()->create([
                'position' => 'projectManager',
                'team_id' => $i
            ]);
            $teams = Team::factory()
                        ->hasUsers(3, [
                            'position' => 'employee'
                        ])
                        ->create([
                            'teamLeaderID' => $leader->id,
                            'projectManagerID' => $manager->id
            ]);
        }

    }
    
}
