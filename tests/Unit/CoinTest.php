<?php

namespace tests\Unit;

use \App\Coin;
use PHPUnit\Framework\TestCase;

class CoinTest extends TestCase
{
    public function test_coin_gets_properly_constructed()
    {
        $coin = new Coin('0.05');

        $this->assertEquals('0.05', $coin->getCode());
        $this->assertEquals(0.05, $coin->getValue());
        $this->assertEquals(0, $coin->getQuantity());
    }

    public function test_set_quantity_sets_the_value()
    {
        $coin = new Coin('0.05');
        $coin->setQuantity(10);

        $this->assertEquals(10, $coin->getQuantity());
    }

    public function test_add_updates_quantity()
    {
        $coin = new Coin('0.05');
        $coin->add(10);

        $this->assertEquals(10, $coin->getQuantity());
    }

    public function test_get_total_amount_returns_right_amount()
    {
        $coin = new Coin('0.05', 8);

        $this->assertEquals(0.4, $coin->getTotalAmount());
    }
}