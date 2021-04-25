<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BctStudent;
use App\Models\BctSubject;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        BctStudent::factory()->count(10)->create();
        BctSubject::factory()->count(5)->create();
    }
}
