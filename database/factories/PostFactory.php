<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{

    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'titulo' => $this->faker->sentence(),
            'extracto' => $this->faker->sentence(),
            'contenido' => $this->faker->paragraph(),
            'caducable' => $this->faker->randomElement([false,true]),
            'comentable' => $this->faker->randomElement([false,true]),
            'acceso' => $this->faker->randomElement(['Privado','Publico'])
        ];
    }
}
