<?php

namespace App;

use App\Exceptions\NotEnoughCoinsException;

class CoinSet
{
    private array $coins = [];

    public function getCoins(): array
    {
        return $this->coins;
    }

    public function getCoin(string $code): ?Coin
    {
        if (!isset($this->coins[$code])) {
            return null;
        }

        return $this->coins[$code];
    }

    public function addCoin(Coin $coin): void
    {
        $this->coins[$coin->getCode()] = $coin;
    }

    public function subtractCoinQuantity(string $code, int $quantity): void
    {
        $coin = $this->getCoin($code);
        $coin->subtract($quantity);
        $this->coins[$code] = $coin;
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

    public function getCoinsForAmount(float $amount): CoinSet
    {
        $coinsForAmount = new CoinSet();
        $coins = $this->getCoins();
        krsort($coins);

        /** @var Coin $coin */
        foreach ($coins as $coin) {
            for ($i = 0; $i < $coin->getQuantity(); $i++) {
                if ((string) ($coinsForAmount->getTotalAmount() + $coin->getValue()) > (string) $amount) {
                    continue;
                }

                if ($coinsForAmount->getCoin($coin->getCode()) === null) {
                    $coinsForAmount->addCoin(new Coin($coin->getCode(), 1));
                } else {
                    $coinsForAmount->getCoin($coin->getCode())->add(1);
                }

                if ($coinsForAmount->getTotalAmount() == $amount) {
                    return $coinsForAmount;
                }
            }
        }

        if ($coinsForAmount->getTotalAmount() < $amount) {
            throw new NotEnoughCoinsException();
        }

        return $coinsForAmount;
    }
}
