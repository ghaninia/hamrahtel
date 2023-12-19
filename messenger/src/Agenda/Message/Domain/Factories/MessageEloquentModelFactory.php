<?php

namespace Src\Agenda\Message\Domain\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Src\Agenda\Message\Infrastructure\EloquentModels\MessageEloquentModel;

class MessageEloquentModelFactory extends Factory
{

    protected $model = MessageEloquentModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->randomDigitNotNull(),
            'title' => fake()->title(),
            'content' => fake()->realText(500),
        ];
    }
}
