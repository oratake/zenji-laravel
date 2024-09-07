<?php

namespace Database\Factories;

use App\Models\Danka;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Danka>
 */
class DankaFactory extends Factory
{
    protected $model = Danka::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $jp_faker = FakerFactory::create("ja_JP");
        return [
            //　'カラム名' => '設定したい値',
            'family_head_last_name' => $jp_faker->lastName(),
            'family_head_first_name' => $jp_faker->firstName(),
            'family_head_last_name_kana' => $jp_faker->lastKanaName(),
            'family_head_first_name_kana' => $jp_faker->firstKanaName(),
            'email' => $jp_faker->unique()->safeEmail(),
            'postcode' => $jp_faker->postcode(),
            'address' => $jp_faker->address(),
            'phone_number' => $jp_faker->phoneNumber(),
            'note' => $jp_faker->realText(),
            'bouzu_id' => 1
        ];
    }
}
