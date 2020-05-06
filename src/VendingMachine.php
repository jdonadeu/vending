<?php

namespace App;

use App\Exceptions\NotEnoughCoinsException;
use App\Exceptions\OperationNotAllowedException;
use App\State\Ready;
use App\State\VendingMachineState;

class VendingMachine
{
    private VendingMachineState $state;
    private CoinDeposit $coinDeposit;
    private float $balance;

    public function __construct()
    {
        $this->setState(new Ready($this));
        $this->coinDeposit = new CoinDeposit();
        $this->balance = 0;
    }

    public function getState(): VendingMachineState
    {
        return $this->state;
    }

    public function setState(VendingMachineState $state): void
    {
        print 'Set state to ' . $state->getCode() . PHP_EOL;
        $this->state = $state;
    }

    public function getCoinDeposit(): CoinDeposit
    {
        return $this->coinDeposit;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function resetBalance(): void
    {
        $this->balance = 0;
    }

    public function addToBalance(float $amount): void
    {
        $this->balance += $amount;
    }

    public function insertCoin(string $code): void
    {
        try {
            $this->state->insertCoin($code);
        } catch (OperationNotAllowedException $e) {
            echo $e->getMessage() . PHP_EOL;
        }
    }

    public function returnCoins(): void
    {
        try {
            $this->state->returnCoins();
        } catch (NotEnoughCoinsException $e) {
            echo $e->getMessage() . PHP_EOL;
        }
    }
}
