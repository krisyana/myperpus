<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //Book Model factories def
            'title' => $this->faker->unique()->sentence(),
            'description' => $this->faker->paragraph(),
            'author' => $this->faker->name(),
            'publisher' => $this->faker->company(),
            'image' => $this->faker->imageUrl(),
            'featured' => $this->faker->randomElement([1, 0]),
            'publisher' => $this->faker->company(),
            'sum' => $this->faker->randomDigit(),
        ];
    }
}
