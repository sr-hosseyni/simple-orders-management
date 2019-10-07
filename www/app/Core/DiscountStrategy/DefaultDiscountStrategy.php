<?php

namespace App\Core\DiscountStrategy;

use App\Order;

/**
 * Description of DefaultDiscountStrategy
 *
 * @author sr_hosseini
 */
class DefaultDiscountStrategy implements StrategyInterface
{
    private const DISCOUNT_PERCENTAGE = 0;

    /**
     * @param Order $order
     * @return float
     */
    public function calculateDiscount(Order $order): float
    {
        return 0;
    }

    /**
     * @return int
     */
    public function getApplyingPercentage(): int
    {
        return self::DISCOUNT_PERCENTAGE;
    }
}
