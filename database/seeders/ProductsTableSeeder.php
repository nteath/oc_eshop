<?php

namespace Database\Seeders;

use Schema;
use App\Models\Product;
use Illuminate\Database\Seeder;


class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Product::truncate();

        Product::factory(10)->create();
    }
}
