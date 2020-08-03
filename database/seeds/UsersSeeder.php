<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for($i = 1; $i <= 10;  $i++) {
            factory(User::class)->create();
        }

    }
}
