<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'amin@gmail.com')->first();
        if (is_null($user)) {
            $user = new User();
            $user->name = "Al Amin";
            $user->email = "amin@gmail.com";
            $user->password = Hash::make('1234568');
            $user->save();
        }
    }
}
