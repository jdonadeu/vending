<?php

namespace App\State;

use App\Coin;
use App\VendingMachine;

class Ready implements VendingMachineState
{
    private const CODE = 'READY';

    private VendingMachine $vendingMachine;

    public function __construct(VendingMachine $vendingMachine)
    {
        $this->vendingMachine = $vendingMachine;
    }

    public function getCode(): string
    {
        return self::CODE;
    }

    public function insertCoin(string $code): void
    {
        $coin = new Coin($code, 1);

        $this->vendingMachine->addToBalance($coin->getTotalAmount());
        $this->vendingMachine->getCoinDeposit()->getCoin($code)->add(1);
    }

    public function returnCoins(): void
    {
        $coinsForAmount = $this->vendingMachine->getCoinDeposit()->getCoinsForAmount($this->vendingMachine->getBalance());

        /** @var Coin $coin */
        foreach($coinsForAmount->getCoins() as $coin) {
            $this->vendingMachine->getCoinDeposit()->subtractCoinQuantity($coin->getCode(), $coin->getQuantity());
        }

        $this->vendingMachine->resetBalance();
    }
}