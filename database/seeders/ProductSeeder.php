<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 500; $i++) {
            DB::table('products')->insert([
                'name' => $faker->word,
                'slug' => $faker->slug,
                'description' => $faker->text,
                'short_description' => $faker->sentence,
                'price' => $faker->randomFloat(2, 1, 1000),
                'main_image' => 'path/to/image.jpg', // Replace with a valid path if you have images
                'multiple_images' => json_encode(['path/to/image1.jpg', 'path/to/image2.jpg']), // Replace with valid paths if you have multiple images
                'stock' => $faker->numberBetween(1, 100),
                'discount' => $faker->randomFloat(2, 0, 100),
                'minimum_dispatch_quantity' => $faker->numberBetween(1, 10),
                'minimum_order_quantity' => $faker->numberBetween(1, 10),
                'send_at_least' => $faker->numberBetween(1, 10),
                'minimum_shipment_qty' => $faker->numberBetween(1, 10),
                'bulk_order_threshold' => $faker->numberBetween(1, 10),
                'minimum_pack_quantity' => $faker->numberBetween(1, 10),
                'required_stock_for_order' => $faker->numberBetween(1, 10),
                'order_min_quantity' => $faker->numberBetween(1, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
