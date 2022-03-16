<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // php artisan db:seed --class=Database\\Seeders\\UserSeeder
        Role::create(['name' => 'admin', 'guard_name' => 'web']);
        Role::create(['name' => 'editor', 'guard_name' => 'web']);

        User::create([
            'name' => 'admin',
            'email' => 'admin@cinebaz.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ])->assignRole('admin');
        User::create([
            'name' => 'editor',
            'email' => 'editor@cinebaz.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ])->assignRole('editor');
    }
}
