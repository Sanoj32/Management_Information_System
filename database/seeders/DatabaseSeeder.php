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
        User::create([
            'name' => "Sanoj Raj Shrestha",
            'password' => Hash::make('password'),
            'email' => 'sanoj.shrestha.13@gmail.com',
            'teacher_code' => "11111"
        ]);
        User::create([
            'name' => "Praches Acharya",
            'password' => Hash::make('zxcvbnm,./'),
            'email' => 'praches@gmail.com',
            'teacher_code' => "22222"
        ]);
        Admin::firstorCreate([
            'name' => "Sanoj Raj Shrestha",
            'email' => "sanoj.shrestha.13@gmail.com",
            'password' => Hash::make('adminpass'),
        ]);
        Admin::firstorCreate([
            'name' => "Praches Acharya",
            'email' => "praches@gmail.com",
            'password' => Hash::make('zxcvbnm,./'),
        ]);

        //SEED THE SUBJECTS
        $jsondata = json_decode(file_get_contents(storage_path('/json_data/bct_subjects.json')), true);
        $storedSubjects = BctSubject::all(['subject_code']);
        $storedSubArray = array();
        foreach ($storedSubjects as $sub) {
            array_push($storedSubArray, $sub['subject_code']);
        }
        foreach ($jsondata as $data) {
            if (in_array($data['subject_code'], $storedSubArray)) {
                echo "DUPLICATE ENTRY!";
                continue;
            }
            $subject = new BctSubject();
            $subject['name'] = $data['name'];
            $subject['subject_code'] = $data['subject_code'];
            $subject['semester'] = $data['semester'];
            $subject->save();
            echo ('NEW SUBJECT ENTRY CREATED!');
            array_push($storedSubArray, $data['subject_code']);
        }

        // SEED THE STUDENTS
        $jsondata = json_decode(file_get_contents(storage_path('/json_data/bct_students.json')), true);
        $storedStudents = BctStudent::all(['roll_number']);
        $storedStudentsArray = array();
        foreach ($storedStudents as $student) {
            array_push($storedStudentsArray, $student['roll_number']);
        }
        foreach ($jsondata as $data) {
            if (in_array($data['roll_number'], $storedStudentsArray)) {
                echo "DUPLICATE ENTRY!!!!!!!!!!!!!!!";
                continue;
            }
            $batch = explode('0', $data['roll_number'])[1];
            $batch = explode('B', $batch)[0];
            $student = new BctStudent();
            $student['name'] = $data['name'];
            $student['roll_number'] = $data['roll_number'];
            $student['group'] = $data['group'];
            $student['batch'] = $batch;
            $student['roll'] = substr($data['roll_number'], -2);
            $student->save();
            echo ('NEW student ENTRY CREATED!');
            array_push($storedStudentsArray, $data['roll_number']);
        }
    }
}
