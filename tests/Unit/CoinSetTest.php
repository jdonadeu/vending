<?php

namespace tests\Unit;

use \App\Coin;
use App\CoinSet;
use PHPUnit\Framework\TestCase;

class CoinSetTest extends TestCase
{
    private CoinSet $coinSet;

    public function setUp(): void
    {
        $this->coinSet = new CoinSet();
        $this->coinSet->addCoin(new Coin('0.05'));
        $this->coinSet->addCoin(new Coin('0.10'));
        $this->coinSet->addCoin(new Coin('0.25'));
        $this->coinSet->addCoin(new Coin('1.00'));
    }

    public function test_add_coin_actually_adds_the_coin()
    {
        $this->coinSet = new CoinSet();
        $coin = new Coin('0.05');
        $this->coinSet->addCoin(new Coin('0.05'));

        $this->assertEquals($coin, $this->coinSet->getCoin('0.05'));
    }

    public function test_get_total_amount_returns_right_amount()
    {
        $this->coinSet->getCoin('0.05')->add(10);
        $this->coinSet->getCoin('0.10')->add(5);
        $this->coinSet->getCoin('0.25')->add(10);
        $this->coinSet->getCoin('1.00')->add(20);

        $this->assertEquals(23.5, $this->coinSet->getTotalAmount());
    }

    public function test_get_coins_for_amount_returns_the_right_set()
    {
        $this->coinSet = new CoinSet();
        $this->coinSet->addCoin(new Coin('0.05', 3));
        $this->coinSet->addCoin(new Coin('0.10', 2));
        $this->coinSet->addCoin(new Coin('0.25', 1));
        $this->coinSet->addCoin(new Coin('1.00', 1));

        $coinsForAmount = $this->coinSet->getCoinsForAmount(1.40);

        $expectedCoinsForAmount = new CoinSet();
        $expectedCoinsForAmount->addCoin(new Coin('0.05', 1));
        $expectedCoinsForAmount->addCoin(new Coin('0.10', 1));
        $expectedCoinsForAmount->addCoin(new Coin('0.25', 1));
        $expectedCoinsForAmount->addCoin(new Coin('1.00', 1));

        $this->assertEquals($expectedCoinsForAmount, $coinsForAmount);
    }
}