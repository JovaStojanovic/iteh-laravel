<?php

namespace Database\Factories;

use App\Models\Genre;
use App\Models\Musician;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Song>
 */
class SongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name"=> $this->faker->sentence(),
            "album"=> $this->faker->sentence(),
            'created_at'=>now(),
            'updated_at'=>now(),
            "genre_id"=> Genre::factory(),
            "musician_id"=> Musician::factory()
        ];
    }
}
