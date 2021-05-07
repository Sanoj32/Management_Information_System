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
        User::factory(10)->create();
        BctStudent::factory()->count(10)->create();
        Admin::firstorCreate([
            'name' => "Sanoj Raj Shrestha",
            'email' => "sanoj.shrestha.13@gmail.com",
            'password' => Hash::make('adminpass'),
        ]);
        $jsondata = json_decode(file_get_contents(storage_path('/json_data/bct_subjects.json')), true);
        $storedSubjects = BctSubject::all(['subject_code']);
        $storedSubArray = array();
        foreach ($storedSubjects as $sub) {
            array_push($storedSubArray, $sub['subject_code']);
        }
        foreach ($jsondata as $data) {
            if (in_array($data['subject_code'], $storedSubArray)) {
                echo "DUPLICATE ENTRY!!!!!!!!!!!!!!!";
                continue;
            }
            $subject = new BctSubject();
            $subject['name'] = $data['name'];
            $subject['subject_code'] = $data['subject_code']; 
            $subject['semester'] = $data['semester'];
            $subject->save();
            echo ('NEW SUBJECT ENTRY CREATED!!!!!!!!!!!!!!!');
            array_push($storedSubArray, $data['subject_code']);
        }
    }
}
