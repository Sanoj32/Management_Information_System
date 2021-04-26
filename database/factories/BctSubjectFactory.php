<?php

namespace Database\Factories;

use App\Models\BctSubject;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BctSubjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BctSubject::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $array = [
            'Mathematics 1', 'Applied Maths', 'Electromagnetics', 'Drawing 1', 'Drawing 2', 'Probability and Statistics', 'Engineering Chemistry', 'Fundamental of Thermodynamics  & Heat Transfer',
            'Workshop Technology', 'Computer Programming', 'Engineering Physics', 'Applied Mechanics', 'Basic Electrical Engineering',
            'Mathematics 2', 'Mathematics 3', 'Object Oriented Programming', 'Electrical Circuit Theory', 'Theory of Computation'
        ];
        return [
            'subject_code' => Str::random(6),
            'name' => $array[array_rand($array, 1)],
            'semester' => rand(1, 8)

        ];
    }
}
