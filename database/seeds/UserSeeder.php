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
            ],
        ];

        User::insert($users);

        $users = User::all();

        foreach($users as $user) {
            $user->profile()->create([
               'bio' => 'My goal is to help my society evolve and develop in every aspect.',
                'image' => asset('storage/no_image.jpg')
            ]);
        }
    }
}
