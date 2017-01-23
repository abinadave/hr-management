<?php

use Illuminate\Database\Seeder;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i=0; $i < 10; $i++) { 
    		$id = DB::table('users')->insertGetId([
	            'name' => str_random(10),
	            'email' => str_random(10).'@gmail.com',
	            'password' => bcrypt('password'),
	        ]);
	        DB::table('employees')->insert([
	            'dob' => rand(1990, 2000) . '-' . rand(1, 12) . '-' . rand(1, 27),
	            'city' => str_random(8) . ' City',
	            'phone' => '09' . rand(0,999999999),
	            'address1' => str_random(16),
	            'address2' => str_random(16),
	            'date_of_joining' => rand(1990, 2000) . '-' . rand(1, 12) . '-' . rand(1, 27),
	            'status' => rand(0, 1),
	            'user_id' => $id,
	            'role' => rand(3, 7)
	        ]);
    	}
        
    }
}
