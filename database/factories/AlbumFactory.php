<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Album>
 */
class AlbumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'song_name'    => $this->faker->sentence(3),
            'artist_name'  => $this->faker->name,
            'album_cover'  => $this->album_cover_default_url(),
        ];
    }

    private function album_cover_default_url()
    {
        return config('app.url') . ':' . config('app.port') .  '/assets/images/album.webp';
    }
}
