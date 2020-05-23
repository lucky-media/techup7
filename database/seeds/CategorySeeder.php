<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * 
     * We create 5 categories from the factory
     * 
     */
    public function run()
    {
        factory(App\Category::class, 5)->create();
    }
}
