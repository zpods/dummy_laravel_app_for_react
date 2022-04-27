<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Image;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Product::factory(100)->create();
        Image::factory(600)->create();

        $users = User::all();

        Product::all()->each(function($product) use ($users){
            $product->users()->attach(
                $users->random(rand(0,3))->pluck('id')->toArray()
            );
        });
    }
}
