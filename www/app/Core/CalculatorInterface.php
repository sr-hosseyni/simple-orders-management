<?php

namespace App\Core;

use App\Order;

/**
 *
 * @author sr_hosseini
 */
interface CalculatorInterface
{
    public function calculate(Order $order): Order;
}
