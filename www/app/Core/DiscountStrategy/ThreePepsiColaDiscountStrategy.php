<?php

namespace App\Core\DiscountStrategy;

use App\Order;

/**
 * Description of BasePriceCalculatorStrategy
 *
 * @author sr_hosseini
 */
class ThreePepsiColaDiscountStrategy implements StrategyInterface
{
    private const DISCOUNT_PERCENTAGE = 20;

    public const PRODUCT_NAME = 'Pepsi Cola';
    public const MINIMUM_REQUIRED_QUANTITY = 3;

    /**
     * @param Order $order
     * @return float
     */
    public function calculateDiscount(Order $order): float
    {
        return $order->total * self::DISCOUNT_PERCENTAGE / 100;
    }

    /**
     * @return int
     */
    public function getApplyingPercentage(): int
    {
        return self::DISCOUNT_PERCENTAGE;
    }
}
