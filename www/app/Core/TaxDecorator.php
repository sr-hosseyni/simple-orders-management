<?php

namespace App\Core;

use App\Order;

/**
 * Tax Decorator
 *
 * @author sr_hosseini
 */
class TaxDecorator extends CalculatorDecorator
{
    /**
     * @param Order $order
     * @return Order
     */
    public function calculate(Order $order): Order
    {
        // There isn't any rule for tax yet!
        return $this->calculator->calculate($order);
    }
}
