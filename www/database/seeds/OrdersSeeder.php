<?php

use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ($user = \App\User())
            ->setName('Rassoul')
            ->setEmail('rassoul.hosseini@gmail.com')
            ->save();

        ($pepsi = new \App\Product())
            ->setName('Pepsi Cola')
            ->setPrice('1.60')
            ->save();

        (new \App\Product())
            ->setName('Coca Cola')
            ->setPrice('1.80')
            ->save();

        (new \App\Product())
            ->setName('Fanta')
            ->setPrice('2.00')
            ->save();

        (new \App\Order())
            ->setUser($user)
            ->setProduct($pepsi)
            ->setQuantity(2)
            ->setTotal($pepsi->getPrice() * 2);
    }
}
