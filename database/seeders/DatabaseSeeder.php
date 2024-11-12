<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        user::factory(100)->create();
        User::factory()->create([
            'name' => 'Test User',
            'last_name' => 'riwi',
            'is_admin' => true,
            'email' =>'user@riwi.io'
        ]);
    }
}
