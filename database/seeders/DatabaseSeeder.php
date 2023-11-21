<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * List of seeder classes.
     *
     * @var string[]
     */
    protected $seeders = [
        ProductsTableSeeder::class,
        CouponsTableSeeder::class,
    ];


    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->seeders as $seedClass) {
            $this->call($seedClass);
        }
    }
}
