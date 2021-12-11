<?php

namespace Database\Factories;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'descripcion' => $this->faker->sentence, //lo definimos como parrafo aleatorio
            'cantidad' => $this->faker->sentence, //lo definimos como parrafo aleatorio
        ];
    }
}
