<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create 3 test users
        User::create([
            'name' => 'Free User',
            'email' => 'free@sisukai.test',
            'password' => bcrypt('password'),
            'is_admin' => false,
            'tier' => 'free'
        ]);

        User::create([
            'name' => 'Pro User',
            'email' => 'pro@sisukai.test',
            'password' => bcrypt('password'),
            'is_admin' => false,
            'tier' => 'pro'
        ]);

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@sisukai.test',
            'password' => bcrypt('password'),
            'is_admin' => true,
            'tier' => 'pro'
        ]);

        // Call certification seeder
        $this->call([
            CertificationSeeder::class,
        ]);
		
		// Call questions seeder
		$this->call([
			CertificationSeeder::class,
			QuestionSeeder::class,
		]);
    }
}
