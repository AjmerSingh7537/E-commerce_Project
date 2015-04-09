<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call('UsersTypeTableSeeder');
        $this->call('CategoriesTableSeeder');
        $this->call('ProductsTableSeeder');
        Model::unguard();
	}

}

class UsersTypeTableSeeder extends Seeder {

    public function run(){
        DB::table('users_type')->delete();

        DB::table('users_type')->insert([
            ['user_type' => 'regular'],
            ['user_type' => 'admin'],
            ['user_type' => 'banned'],
        ]);
    }
}

class CategoriesTableSeeder extends Seeder {

    public function run(){
        DB::table('categories')->delete();

        DB::table('categories')->insert([
            ['category_name' => 'Computers'],
            ['category_name' => 'Cameras'],
            ['category_name' => 'Phones'],
            ['category_name' => 'Tablets'],
        ]);
    }
}

class ProductsTableSeeder extends Seeder {

    public function run(){
        DB::table('products')->delete();

        DB::table('products')->insert([
            [
                'category_id' => '1',
                'product_name' => 'First Product',
                'description' => 'This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'price' => '22.99',
                'quantity' => '20',
                'image' => 'product1.jpg',
                'slug' => 'first-product'
            ],
            [
                'category_id' => '1',
                'product_name' => 'Second Product',
                'description' => 'This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'price' => '21.99',
                'quantity' => '32',
                'image' => 'product2.png',
                'slug' => 'second-product'
            ],
            [
                'category_id' => '2',
                'product_name' => 'Third Product',
                'description' => 'This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'price' => '25.99',
                'quantity' => '12',
                'image' => 'product3.jpg',
                'slug' => 'third-product'
            ],
            [
                'category_id' => '2',
                'product_name' => 'Fourth Product',
                'description' => 'This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'price' => '22.93',
                'quantity' => '43',
                'image' => 'product4.jpg',
                'slug' => 'fourth-product'
            ],
            [
                'category_id' => '3',
                'product_name' => 'Fifth Product',
                'description' => 'This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'price' => '27.95',
                'quantity' => '13',
                'image' => 'product5.jpg',
                'slug' => 'fifth-product'
            ],
            [
                'category_id' => '3',
                'product_name' => 'Sixth Product',
                'description' => 'This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'price' => '29.99',
                'quantity' => '53',
                'image' => 'product6.jpg',
                'slug' => 'sixth-product'
            ],
            [
                'category_id' => '4',
                'product_name' => 'Seventh Product',
                'description' => 'This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'price' => '23.92',
                'quantity' => '41',
                'image' => 'product7.png',
                'slug' => 'seventh-product'
            ],
        ]);
    }
}
