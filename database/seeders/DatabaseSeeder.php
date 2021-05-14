<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::factory(20)->create();
        // \App\Models\Book::factory(20)->create();
        // \App\Models\User::factory(20)->create();


        $categories = \App\Models\Category::all();

        \App\Models\User::factory(20)->create()->each(function ($u) {
            \App\Models\Book::factory(5)->create()->each(function ($e) use ($u) {
                \App\Models\Rent::factory(3)->create([
                    'user_id' => $u->id,
                    'book_id' => $e->id,
                ]);
            });
        });

        \App\Models\Book::all()->each(function ($book) use ($categories) {
            $book->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
