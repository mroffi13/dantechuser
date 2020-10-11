<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = collect([
            [
                'name' => 'Mohammad Roffi Suhendry',
                'email' => 'asd@gmail.com'
            ],
            [
                'name' => 'Mohammad Roffi',
                'email' => 'asd123@gmail.com'
            ]
        ]);

        $users->each(function ($user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => '$2y$10$Rn1kxKkwc3itwUpq4pV68eWUR4SQMuioLmNCGEaMOFGH2IHBmHTEC', //secret
                'address' => 'cibinong',
                'api_token' => Str::random(40)
            ]);
        });
    }
}
