<?php

use App\Checklist;
use App\User;
use Illuminate\Database\Seeder;

class ChecklistsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach($users as $user){
            $checklists = rand(1,5);

            for($i = 1; $i <= $checklists; $i++){
                factory(Checklist::class)->create([
                    'name' => $user->first_name . "'s Checklist # " . $i,
                    'is_template' => rand(0,1),
                    'is_completed'=> 0, 
                    'user_id' => $user->id
                ]);
    
            }
        }
    }
}
