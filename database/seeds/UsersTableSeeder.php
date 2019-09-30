<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;
use App\Groups;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Eloquent::unguard();

		$faker = Faker::create('en_GB');

		// Prepare Groups
		$groups = [1 => 'Admin', 2 => 'Group 1',3 => 'Group 2', 4 =>'Group 3'];

		// Prepare Admin Users
		$admin_users = [
			[
				'email' => 'admin1@test.com',
				'name' => 'Admin 1',
				'password' => '123456',
				'admin' => 1,
				'group' => 1,
				'job_title' => $faker->jobTitle,
				'dob' => date('Y-m-d',strtotime(rand(strtotime('1965-01-01'),strtotime('2010-01-10')))),
				'phone' => $faker->phoneNumber,
				'extension' => rand(100,400) 
			],
			[
				'email' => 'admin2@test.com',
				'name' => 'Admin 2',
				'password' => '123456',
				'admin' => 1,
				'group' => 1,
				'job_title' => $faker->jobTitle,
				'dob' => date('Y-m-d',strtotime(rand(strtotime('1965-01-01'),strtotime('2010-01-10')))),
				'phone' => $faker->phoneNumber,
				'extension' => rand(100,400) 
			]
		];

		// Prepare Normal Users
		$users = [];
		foreach (range(1,100) as $i) {
			$group = rand(2,4);
			$name = $faker->firstName.' '.$faker->lastName;
			$users[] = [
				'email' => strtolower(str_replace(' ','.',$name).rand(1,21).'@test.com'),
				'name' => $name,
				'password' => '123456',
				'admin' => 0,
				'group' => $group,
				'job_title' => $faker->jobTitle,
				'dob' => date('Y-m-d',strtotime(rand(strtotime('1965-01-01'),strtotime('2010-01-10')))),
				'phone' => $faker->phoneNumber,
				'extension' => rand(100,400) 
			];
		}

		// Create Groups
		
		foreach ($groups as $id => $group) {
			Groups::create([
				'id' => $id,
				'group_name' => $group,
				'description' => $faker->text(100)
			]);
		}

		foreach ($admin_users as $user) {
			User::create($user);
		}

		foreach ($users as $user) {
			User::create($user);
		}
    }
}
