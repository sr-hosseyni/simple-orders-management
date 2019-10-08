<?php

namespace Tests\Unit\Mock;

use App\Core\CalculatorInterface;
use App\Order;

/**
 * Mocked TotalPrice Decorator
 * Calculate Total price of order
 *
 * @author sr_hosseini
 */
class CalculatorDecoratorMock implements CalculatorInterface
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
