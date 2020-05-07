<?php

namespace App;

use App\Exceptions\NotEnoughBalanceException;
use App\Exceptions\NotEnoughCoinsException;
use App\Exceptions\NotEnoughItemsException;
use App\Exceptions\OperationNotAllowedException;
use App\State\Ready;
use App\State\VendingMachineState;

class VendingMachine
{
    private VendingMachineState $state;
    private CoinDeposit $coinDeposit;
    private ItemDeposit $itemDeposit;
    private float $balance;

    public function __construct()
    {
        $this->setState(new Ready($this));
        $this->coinDeposit = new CoinDeposit();
        $this->itemDeposit = new ItemDeposit();
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

    public function getItemDeposit(): ItemDeposit
    {
        return $this->itemDeposit;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function setBalance(float $balance): void
    {
        if ($balance < 0) {
            throw new \Exception();
        }

        $this->balance = $balance;
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
            print $e->getMessage() . PHP_EOL;
        }
    }

    public function returnCoins(): void
    {
        try {
            $this->state->returnCoins();
        } catch (NotEnoughCoinsException $e) {
            print $e->getMessage() . PHP_EOL;
        }
    }

    public function buy(string $itemCode): void
    {
        try {
            $this->state->buy($itemCode);
        } catch (NotEnoughCoinsException $e) {
            print 'Not enough coins to return change' . PHP_EOL;
        } catch (\Exception $e) {
            print $e->getMessage() . PHP_EOL;
        }
    }
}
