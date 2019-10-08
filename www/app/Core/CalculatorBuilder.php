<?php

namespace App\Core;

use App\Order;

/**
 * Description of CalculatorBuilder
 *
 * @author sr_hosseini
 */
final class CalculatorBuilder
{
    /**
     *
     * @var CalculatorInterface
     */
    private $calculator;

    /**
     * CalculatorBuilder constructor.
     */
    public function __construct()
    {
        $this->calculator = new TotalPriceCalculator();
    }
    
    /**
     * 
     * @return self
     */
    public function applyTax(): self
    {
        $this->calculator = new TaxDecorator($this->calculator);
        return $this;
    }

    /**
     * 
     * @return self
     */
    public function applyDiscount(): self
    {
        $this->calculator = new DiscountDecorator($this->calculator);
        return $this;
    }

    /**
     * 
     * @return CalculatorInterface
     */
    public function build(): CalculatorInterface
    {
        return $this->calculator;
    }
}
