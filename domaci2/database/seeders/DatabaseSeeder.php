<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductType;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Product::truncate();
        ProductType::truncate();

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $user3 = User::factory()->create();

        $type1 = ProductType::factory()->create();
        $type2 = ProductType::factory()->create();

        Product::factory(3)->create([
            'user_id'=>$user1->id,
            'product_type'=>$type1->id
        ]);
        Product::factory(4)->create([
            'user_id'=>$user2->id,
            'product_type'=>$type1->id
        ]);
        Product::factory(2)->create([
            'user_id'=>$user3->id,
            'product_type'=>$type2->id
        ]);
    }
}
