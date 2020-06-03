<?php

use Illuminate\Database\Seeder;
use App\User;
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
        // We create the superadmin, an instructor and a student for testing purposes
        // The password for all of them is "secret"

        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@test.com',
                'username' => 'admin',
                'role' => 'admin',
                'password' => Hash::make('secret'),
            ],
            [
                'name' => 'Instructor',
                'email' => 'instructor@test.com',
                'username' => 'instructor',
                'role' => 'instructor',
                'password' => Hash::make('secret'),
            ],
            [
                'name' => 'Student',
                'email' => 'student@test.com',
                'username' => 'student',
                'role' => 'student',
                'password' => Hash::make('secret'),
            ]
        ];

        foreach ($users as $user){
            factory(App\User::class)->create($user);
        }
    }
}
