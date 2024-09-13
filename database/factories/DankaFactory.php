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
        $address = fake()->prefecture() . fake()->city() . fake()->streetAddress() . fake()->secondaryAddress();
        return [
            //　'カラム名' => '設定したい値',
            'family_head_last_name' => fake()->lastName(),
            'family_head_first_name' => fake()->firstName(),
            'family_head_last_name_kana' => fake()->lastKanaName(),
            'family_head_first_name_kana' => fake()->firstKanaName(),
            'email' => fake()->unique()->safeEmail(),
            'postcode' => fake()->postcode(),
            'address' => $address,
            'phone_number' => preg_replace('/[-]/', '', fake()->phoneNumber()),
            'note' => fake()->realText(50),
            'bouzu_id' => 1
        ];
    }
}
