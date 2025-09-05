<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id, // 既存カテゴリからランダム選択
            'first_name'  => $this->faker->firstName,
            'last_name'   => $this->faker->lastName,
            'gender'      => $this->faker->numberBetween(1, 3), // 1=男性,2=女性,3=その他
            'email'       => $this->faker->unique()->safeEmail,
            'tel'         => $this->faker->phoneNumber,
            'address'     => $this->faker->address,
            'building'    => $this->faker->optional()->secondaryAddress, // NULL or 値
            'detail'      => $this->faker->realText(200), // お問合せ内容
        ];
    }
}
