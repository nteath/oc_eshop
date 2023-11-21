<?php

namespace Database\Seeders;

use Schema;
use App\Models\Coupon;
use Illuminate\Database\Seeder;


class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Coupon::truncate();

        Coupon::factory(5)->create();

        Coupon::create([
            'code'  => 'oc',
            'value' => 500,
        ]);
    }
}
