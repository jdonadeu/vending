<?php

namespace tests\Unit;

use \App\Coin;
use App\CoinDeposit;
use PHPUnit\Framework\TestCase;

class CoinDepositTest extends TestCase
{
    private CoinDeposit $coinDeposit;

    public function setUp(): void
    {
        $this->coinDeposit = new CoinDeposit();
        $this->coinDeposit->addCoin(new Coin('0.05'));
        $this->coinDeposit->addCoin(new Coin('0.10'));
        $this->coinDeposit->addCoin(new Coin('0.25'));
        $this->coinDeposit->addCoin(new Coin('1.00'));
    }

    public function test_add_coin_actually_adds_the_coin()
    {
        $this->coinDeposit = new CoinDeposit();
        $coin = new Coin('0.05');
        $this->coinDeposit->addCoin(new Coin('0.05'));

        $this->assertEquals($coin, $this->coinDeposit->getCoin('0.05'));
    }

    public function test_get_total_amount_returns_right_amount()
    {
        $this->coinDeposit->getCoin('0.05')->add(10);
        $this->coinDeposit->getCoin('0.10')->add(5);
        $this->coinDeposit->getCoin('0.25')->add(10);
        $this->coinDeposit->getCoin('1.00')->add(20);

        $this->assertEquals(23.5, $this->coinDeposit->getTotalAmount());
    }
}