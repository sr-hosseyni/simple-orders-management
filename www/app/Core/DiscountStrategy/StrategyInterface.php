<?php

namespace App\Core\DiscountStrategy;

use App\Order;

/**
 *
 * @author sr_hosseini
 */
interface StrategyInterface
{
    public function calculateDiscount(Order $order): float;
    public function getApplyingPercentage(): int;
}
