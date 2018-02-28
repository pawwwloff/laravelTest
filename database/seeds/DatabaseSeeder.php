<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
    	$this->call(ProductsTableSeeder::class);
    }
}

class ProductsTableSeeder extends Seeder
{
	public function run(){
		DB::table('products')->delete();
		 
		$products = array(
				array(
						'name' => 'Сыр',
						'description' => 'Алтайский сыр',
						'price' => '400'
				),
				array(
						'name' => 'Блины',
						'description' => 'Бабушкины',
						'price' => '150'
				),
				array(
						'name' => 'Карачинская',
						'description' => 'Водийа карачинская',
						'price' => '25'
				)
		);
		 
		DB::table('products')->insert($products);
		 
	}
}