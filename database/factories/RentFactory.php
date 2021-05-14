<?php

namespace Database\Factories;

use App\Models\Rent;
use Illuminate\Database\Eloquent\Factories\Factory;

class RentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //seeding rents with faker
            'status' => $this->faker->randomElement(['done', 'pending', 'renting']),
            'rent_at' => $this->faker->dateTimeBetween($startDate = '-5 days', $endDate = 'now', $timezone = null, $format = 'Y-m-d'),
            'return_at' => $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+ 5days', $timezone = null, $format = 'Y-m-d'),
        ];
    }
}
