<?php

namespace App\State;

use App\Coin;
use App\Exceptions\NotEnoughBalanceException;
use App\Exceptions\NotEnoughItemsException;
use App\Exceptions\OperationNotAllowedException;
use App\VendingMachine;

class ReadyState implements VendingMachineState
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
        $this->vendingMachine->getCoinDeposit()->subtractCoinSet($coinsForAmount);
        $this->vendingMachine->setBalance(0);
    }

    public function buy(string $itemCode): void
    {
        $item = $this->vendingMachine->getItemDeposit()->getItem($itemCode);

        if ($item->getPrice() > $this->vendingMachine->getBalance()) {
            throw new NotEnoughBalanceException();
        }

        if ($item->getQuantity() == 0) {
            throw new NotEnoughItemsException();
        }

        $change = $this->vendingMachine->getBalance() - $item->getPrice();
        $coinsForAmount = $this->vendingMachine->getCoinDeposit()->getCoinsForAmount($change);

        $this->vendingMachine->getItemDeposit()->getItem($itemCode)->subtract(1);
        $this->vendingMachine->getCoinDeposit()->subtractCoinSet($coinsForAmount);
        $this->vendingMachine->setBalance(0);
    }

    public function replenishCoin(string $coinCode): void
    {
        throw new OperationNotAllowedException();
    }

    public function replenishItem(string $itemCode): void
    {
        throw new OperationNotAllowedException();
    }
}