<?php

namespace App\Core;


use App\Core\DiscountStrategy\DiscountStrategyFactory;
use App\Order;

/**
 * Calculator service for insurance order
 *
 * @author sr_hosseini
 */
class DiscountDecorator extends CalculatorDecorator
{
    public function calculate(Order $order): Order
    {
        $order = $this->calculator->calculate($order);
        $this
            ->discountBasedOnProduct($order)
            ->discountBasedOnQuantity($order)
            ->discountBasedOnProductAndQuantity($order);

        return $order;
    }

    /**
     * @param Order $order
     * @return DiscountDecorator
     */
    protected function discountBasedOnProduct(Order $order): self
    {
        $strategy = DiscountStrategyFactory::getActiveStrategyByProduct($order->product);
        $discount = $strategy->calculateDiscount($order);
        $order->total -= $discount;

        return $this;
    }

    /**
     * @param Order $order
     * @return DiscountDecorator
     */
    protected function discountBasedOnQuantity(Order $order): self
    {
        $strategy = DiscountStrategyFactory::getActiveStrategyByQuantity($order->quantity);
        $discount = $strategy->calculateDiscount($order);
        $order->total -= $discount;

        return $this;
    }

    /**
     * @param Order $order
     * @return DiscountDecorator
     */
    protected function discountBasedOnProductAndQuantity(Order $order): self
    {
        $strategy = DiscountStrategyFactory::getActiveStrategyByProductAndQuantity($order->product, $order->quantity);
        $discount = $strategy->calculateDiscount($order);
        $order->total -= $discount;

        return $this;
    }
}
