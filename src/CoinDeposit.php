<?php

namespace App;

class CoinDeposit
{
    private array $coins = [];

    public function getCoins(): array
    {
        return $this->coins;
    }

    public function getCoin(string $code): Coin
    {
        return $this->coins[$code];
    }

    public function addCoin(Coin $coin): void
    {
        $this->coins[$coin->getCode()] = $coin;
    }

    public function getTotalAmount(): float
    {
        $total = 0;

        /** @var Coin $coin */
        foreach ($this->getCoins() as $coin) {
            $total += $coin->getTotalAmount();
        }

        return $total;
    }
}
