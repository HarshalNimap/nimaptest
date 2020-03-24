<?php

use Illuminate\Database\Seeder;
use App\product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 50;
        factory(product::class, $count)->create();
    }
}
