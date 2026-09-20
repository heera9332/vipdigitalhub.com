<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        if (! User::where('email', 'admin@vipdigitalhub.com')->exists()) {
            User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@vipdigitalhub.com',
            ]);
        }

        $this->call([
            SiteSettingSeeder::class,
            ProjectSeeder::class,
            ServiceSeeder::class,
            PostSeeder::class,
        ]);
    }
}
