<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'purchase_price'=>100,
            'sale_price'=>120,
            'stock'=>60,
            'category_id'=>1,
            'name'=>[
                'en'=>'Samsung A70',
                'ar'=>'سامسونغ A70'
            ]
        ]);
    }
}
