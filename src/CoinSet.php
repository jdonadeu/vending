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

    public function subtractCoinSet(CoinSet $coinSet): void
    {
        /** @var Coin $coin */
        foreach($coinSet->getCoins() as $coin) {
            $this->getCoin($coin->getCode())->subtract($coin->getQuantity());
        }
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
                    break;
                }

                if ($coinsForAmount->getCoin($coin->getCode()) === null) {
                    $coinsForAmount->addCoin(new Coin($coin->getCode(), 1));
                } else {
                    $coinsForAmount->getCoin($coin->getCode())->add(1);
                }

                if ((string) $coinsForAmount->getTotalAmount() == (string) $amount) {
                    return $coinsForAmount;
                }
            }
        }

        if ((string) $coinsForAmount->getTotalAmount() < (string) $amount) {
            throw new NotEnoughCoinsException();
        }

        return $coinsForAmount;
    }
}
