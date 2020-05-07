<?php

namespace App\State;

use App\Exceptions\OperationNotAllowedException;
use App\VendingMachine;

class ServiceState implements VendingMachineState
{
    private const CODE = 'SERVICE';

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
        throw new OperationNotAllowedException();
    }

    public function returnCoins(): void
    {
        throw new OperationNotAllowedException();
    }

    public function buy(string $itemCode): void
    {
        throw new OperationNotAllowedException();
    }

    public function replenishCoin(string $coinCode): void
    {
        $this->vendingMachine->getCoinDeposit()->getCoin($coinCode)->add(1);
    }

    public function replenishItem(string $itemCode): void
    {
        $this->vendingMachine->getItemDeposit()->getITem($itemCode)->add(1);
    }
}