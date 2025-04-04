<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;
use App\Models\User;
use Faker\Factory as Faker;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $users = User::all()->pluck('id')->toArray();

        for ($i = 0; $i < 250; $i++) {
            Car::create($this->generateCarData($faker, $users));
        }
    }

    /**
     * Genereert een willekeurige auto met realistische data.
     */
    private function generateCarData($faker, $users): array
    {
        $brands = [
            'Mazda', 'VW', 'Seat', 'BMW', 'Audi', 'Mercedes', 'Honda',
            'Toyota', 'Nissan', 'Ford', 'Chevrolet', 'Porsche',
            'Fiat', 'Volvo', 'Tesla', 'Hyundai', 'Kia',
            'Peugeot', 'Citroen', 'Renault', 'Subaru',
            'Jaguar', 'Land Rover', 'Skoda', 'Mini',
            'Mitsubishi', 'Jeep', 'Dodge', 'Ram',
        ];

        $colors = [
            'Red', 'Blue', 'Black', 'White', 'Silver', 'Green', 'Yellow', 'Orange',
            'Grey', 'Brown', 'Gold', 'Beige', 'Purple'
        ];

         $images = [
            '3A6CssOH0yTMQYlQwm9eXTrIB5dmoSo5NruSxAYG.jpg'
        ];
        // Maak de afbeelding en sla deze lokaal op
        $imagePath = $faker->image(storage_path('app/public/cars'), 640, 480, 'cars', false);
        $imageUrl = 'cars/' . $imagePath; // Sla de afbeelding op zonder 'storage/' prefix

        return [
            'user_id' => $faker->randomElement($users),
            'license_plate' => strtoupper($faker->bothify('??-##-??')),
            'brand' => $faker->randomElement($brands),
            'model' => ucfirst($faker->word),
            'price' => $faker->randomFloat(2, 1000, 50000),
            'mileage' => $faker->numberBetween(0, 200000),
            'seats' => $faker->numberBetween(2, 7),
            'doors' => $faker->numberBetween(2, 5),
            'production_year' => $faker->year(),
            'weight' => $faker->numberBetween(800, 3000),
            'color' => $faker->randomElement($colors),
            'image' =>$faker->randomElement($images), 
            'sold_at' => $faker->optional(0.3)->dateTime(),
            'views' => $faker->numberBetween(0, 5000),
        ];
    }
}
