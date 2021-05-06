<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use App\Models\BctStudent;
use App\Models\BctSubject;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        // BctStudent::factory()->count(10)->create();
        // Admin::firstorCreate([
        //     'name' => "Sanoj Raj Shrestha",
        //     'email' => "sanoj.shrestha.13@gmail.com",
        //     'password' => Hash::make('adminpass'),
        // ]);
        $jsondata = json_decode(file_get_contents(storage_path('/json_data/bct_subjects.json')), true);
        $storedSubjects = BctSubject::all(['subject_code'])->toArray();
        foreach ($jsondata as $data) {
            // if (in_array($data->subject_code, $storedSubjects)) {
            //     echo "Its here";
            // }
            echo $data->name;
        }
    }
}
