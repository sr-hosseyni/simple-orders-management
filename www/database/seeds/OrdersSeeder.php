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
        $user1 = new \App\User();
        $user1->name = 'Rassoul';
        $user1->email = 'rassoul.hosseini@gmail.com';
        $user1->save();

        $user2 = new \App\User();
        $user2->name = 'Ehsan';
        $user2->email = 'hossein@gmail.com';
        $user2->save();

        $user3 = new \App\User();
        $user3->name = 'Someone';
        $user3->email = 'someone@somewhere.com';
        $user3->save();

        $pepsi = new \App\Product();
        $pepsi->name = 'Pepsi Cola';
        $pepsi->price = '1.60';
        $pepsi->save();

        $coca = new \App\Product();
        $coca->name = 'Coca Cola';
        $coca->price = '1.80';
        $coca->save();

        $fanta = new \App\Product();
        $fanta->name = 'Fanta';
        $fanta->price = '2.00';
        $fanta->save();

        $order1 = new \App\Order();
        $order1->quantity = 2;
        $order1->total = $pepsi->price * $order1->quantity;
        $order1->user_id = $user1->id;
        $order1->product_id = $pepsi->id;
        $order1->created_at = gmdate('Y-m-d H:i:s', strtotime('10 days ago'));
        $order1->updated_at = gmdate('Y-m-d H:i:s', strtotime('10 days ago'));
        $order1->save(['timestamps' => false]);

        $order2 = new \App\Order();
        $order2->quantity = 2;
        $order2->total = $coca->price * $order2->quantity;
        $order2->user_id = $user2->id;
        $order2->product_id = $coca->id;
        $order2->created_at = gmdate('Y-m-d H:i:s', strtotime('5 days ago'));
        $order2->updated_at = gmdate('Y-m-d H:i:s', strtotime('5 days ago'));
        $order2->save(['timestamps' => false]);

        $order3 = new \App\Order();
        $order3->quantity = 2;
        $order3->total = $fanta->price * $order3->quantity;
        $order3->user_id = $user2->id;
        $order3->product_id = $fanta->id;
        $order3->created_at = gmdate('Y-m-d H:i:s', strtotime('2 days ago'));
        $order3->updated_at = gmdate('Y-m-d H:i:s', strtotime('2 days ago'));
        $order3->save(['timestamps' => false]);

        $order4 = new \App\Order();
        $order4->quantity = 2;
        $order4->total = $coca->price * $order4->quantity;
        $order4->user_id = $user3->id;
        $order4->product_id = $coca->id;
        $order4->created_at = gmdate('Y-m-d H:i:s', strtotime('10 hours ago'));
        $order4->updated_at = gmdate('Y-m-d H:i:s', strtotime('10 hours ago'));
        $order4->save(['timestamps' => false]);
    }
}
