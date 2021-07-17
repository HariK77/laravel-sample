<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = ['Hari', 'Krishna', 'HariK', 'Maxx', 'He', 'Steel'];

        $product_names = ['Hari Krishna', 'Get Ready', 'You Can Do It', 'Nothing Is Impossible', 'Go For It', 'Come Again'];

        for ($i=0; $i < 2500; $i++) {
	    	Product::create([
	            'product_name' => $product = $product_names[mt_rand(0, 5)],
	            'product_slug' => Str::slug($product, '-'),
                'brand' => $brands[mt_rand(0, 5)],
                'price' => mt_rand(999, 3000),
                'model_name' => 'HariK'.mt_rand(777, 7777),
                'short_desc' => "This is short Description",
                'description' => "This is long description, so it should long and very descriptive.",
                'featured' => mt_rand(0, 1),
                'available' => mt_rand(0, 1),
                'active_flag' => mt_rand(0, 1),
	        ]);
    	}
    }
}
