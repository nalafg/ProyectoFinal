<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(CategorySeeder::class);
        $this->call(MovieSeeder::class);
        $this->call(UserTableSeeder::class);
    	$this->call(LoanSeeder::class);
        
        // \App\Models\User::factory(10)->create();
        #php artisan db:seed
        #php artisan migrate:fresh --seed
    }
}
