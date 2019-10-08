<?php

namespace Tests\Unit\Suite\App\Core;

use App\Core\DiscountDecorator;
use App\Order;
use App\Product;
use Calculator\Services\Validation\Validators\Required;
use Tests\TestCase;
use Tests\Unit\Mock\CalculatorDecoratorMock;

class DiscountCalculatorTest extends TestCase
{
    public function dataProvider(): array
    {
        return [
            [$productName = 'Pepsi Cola', $productPrice = 2.00, $quantity = 5, 10.00 * 0.8], // 20 percent off
            [$productName = 'Pepsi Cola', $productPrice = 2.00, $quantity = 3, 6.00 * 0.8], // 20 percent off
            [$productName = 'Pepsi Cola', $productPrice = 1.50, $quantity = 3, 1.50 * 3 * 0.8], // 20 percent off
            [$productName = 'Coca Cola', $productPrice = 2.00, $quantity = 3, 6.00],
            [$productName = 'Fanta', $productPrice = 2.00, $quantity = 3, 6.00],
            [$productName = 'Pepsi Cola', $productPrice = 2.00, $quantity = 2, 4.00],
            [$productName = 'Pepsi Cola', $productPrice = 2.00, $quantity = 1, 2.00],
        ];
    }

    /**
     * @param string $productName
     * @param float $productPrice
     * @param int $quantity
     * @param float $expected
     *
     * @dataProvider dataProvider
     */
    public function testCalculateDiscount(string $productName, float $productPrice, int $quantity, float $expected)
    {
        $order = new Order();
        $order->product = new Product();
        $order->product->name = $productName;
        $order->product->price = $productPrice;
        $order->quantity = $quantity;
        $order->total = $productPrice * $quantity;

        $calculator = new DiscountDecorator(new CalculatorDecoratorMock());
        $calculator->calculate($order);
        $this->assertEquals($expected, $order->total);
    }
}
