<?php

namespace Database\Seeders\Managers;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Managers\Manager::factory()->create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'super@admin.com',
        ]);
        
        \App\Models\Managers\Manager::factory(2)->create();
    }
}
