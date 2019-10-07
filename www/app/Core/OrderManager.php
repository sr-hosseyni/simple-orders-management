<?php

namespace App\Core;

use App\Order;
use App\Product;
use App\User;

/**
 * Class OrderManager
 * @package App\Core
 */
class OrderManager
{
    public function create(User $user, Product $product, int $quantity = 1): Order
    {
        $order = new Order();
        $order->user_id = $user->id;
        $order->product_id = $product->id;
        $order->quantity = $quantity;


        $order = $this
            ->makeCalculator()
            ->calculate($order);

        $order->save();

        return $order;
    }

    /**
     * @return CalculatorInterface
     */
    public function makeCalculator(): CalculatorInterface
    {
        return (new CalculatorBuilder())
            ->applyTax()
            ->applyDiscount()
            ->build();
    }
}
