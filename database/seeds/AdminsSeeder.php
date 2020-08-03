<?php

use App\Admin;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $iago = factory(User::class)->create([
            'first_name' => 'Iago',
            'last_name' => 'Avelino',
            'nickname' => 'jackofheartz',
            'address' => 'Rua François Teles de Menezes, 50',
            'address_complement' => 'Bloco 11, AP 205',
            'email' => 'iago@chklists.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // password
            'remember_token' => Str::random(10),
        ]);

        $iago_adm = factory(Admin::class)->create([
            'name' => $iago->first_name,
            'user_id' => $iago->id
        ]);
    }
}
