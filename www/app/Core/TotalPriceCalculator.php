<?php

namespace App\Core;

use App\Order;

/**
 * TotalPrice Decorator
 * Calculate Total price of order
 *
 * @author sr_hosseini
 */
class TotalPriceCalculator implements CalculatorInterface
{
    /**
     * @param Order $order
     * @return Order
     */
    public function calculate(Order $order): Order
    {
        $order->total = $order->product->price * $order->quantity;
        
        return $order;
    }

}
