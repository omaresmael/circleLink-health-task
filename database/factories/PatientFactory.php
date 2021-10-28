<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    protected $model = Patient::class;
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'blood_pressure' => $this->faker->randomElement(['120/80', '90/60','140/90']),
        ];
    }
}
