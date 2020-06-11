<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::all();
        
        $locale = ['en', 'sq', 'mk'];

        foreach($users as $user){
            $user->settings()->create([
                'locale' => Arr::random($locale)
            ]);
        }
    }
}
