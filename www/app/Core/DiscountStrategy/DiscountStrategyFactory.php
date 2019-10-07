<?php

namespace App\Core\DiscountStrategy;

use App\Order;
use App\Product;

/**
 * Description of BasePriceCalculator
 *
 * @author sr_hosseini
 */
class DiscountStrategyFactory
{
    /**
     * @param Product $product
     * @return DefaultDiscountStrategy|ThreePepsiColaDiscountStrategy
     */
    public static function getActiveStrategyByProductAndQuantity(Product $product, int $quantity): StrategyInterface
    {
        if (
            $product->name == ThreePepsiColaDiscountStrategy::PRODUCT_NAME &&
            $quantity >= ThreePepsiColaDiscountStrategy::MINIMUM_REQUIRED_QUANTITY
        ) {
            return new ThreePepsiColaDiscountStrategy();
        }
        
        return new DefaultDiscountStrategy();
    }

    /**
     * @param Product $product
     * @return DefaultDiscountStrategy|ThreePepsiColaDiscountStrategy
     */
    public static function getActiveStrategyByProduct(Product $product): StrategyInterface
    {
        return new DefaultDiscountStrategy();
    }

    /**
     * @param int $quantity
     * @return DefaultDiscountStrategy
     */
    public static function getActiveStrategyByQuantity(int $quantity): StrategyInterface
    {
        return new DefaultDiscountStrategy();
    }
}
