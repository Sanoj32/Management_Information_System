<?php

namespace Database\Factories;

use App\Models\BctStudent;
use Illuminate\Database\Eloquent\Factories\Factory;

class BctStudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BctStudent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'group' => null,
            'roll_number' => 'lec' . '0' . strval(rand(50, 99)) . 'bct' . strval(rand(01, 99)),
        ];
    }
}
