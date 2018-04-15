<?php

use Illuminate\Database\Seeder;
use App\Item;
class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'name' => 'Pizza',
                'price' => 499.99,
            ],
            [
                'name' => 'Hamburguesa',
                'price' => 299.99,
            ],
            [
                'name' => 'Pasta Carbonara',
                'price' => 199.99,
            ],
            [
                'name' => 'Ensalada Cesar',
                'price' => 249.99,
            ],
        ];

        foreach($items as $item) {
            Item::firstOrCreate(['name' => $item['name']], $item);
        }
    }
}
