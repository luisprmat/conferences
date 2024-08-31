<?php

namespace Database\Factories;

use App\Enums\Speaker\Qualification;
use App\Models\Speaker;
use App\Models\Talk;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpeakerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Speaker::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $qualificationsCount = $this->faker->numberBetween(0, 10);
        $qualifications = $this->faker->randomElements(Qualification::class, $qualificationsCount);

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'bio' => $this->faker->text(),
            'qualifications' => $qualifications,
            'xcom_handle' => $this->faker->word(),
        ];
    }

    public function withTalks(int $count = 1)
    {
        return $this->has(Talk::factory()->count($count), 'talks');
    }
}
