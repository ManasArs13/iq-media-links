<?php

namespace Database\Seeders;

use App\Models\Link;
use App\Models\User;
use App\Models\Visit;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create()->each(function ($user) {
            $user->links()->saveMany(
                Link::factory(5)->make()
            )->each(function ($link) {
                $link->visits()->saveMany(
                    Visit::factory(rand(0, 50))->make()
                );
            });
        });
    }
}
