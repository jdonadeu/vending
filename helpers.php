<?php

use App\Coin;
use App\CoinDeposit;
use App\VendingMachine;

function menu()
{
    print PHP_EOL;
    print '(1) Insert 0.05 coin' . PHP_EOL;
    print '(2) Insert 0.10 coin' . PHP_EOL;
    print '(3) Insert 0.25 coin' . PHP_EOL;
    print '(4) Insert 1.00 coin' . PHP_EOL;
    print '(r) Return coins' . PHP_EOL;
    print '(x) Exit' . PHP_EOL . PHP_EOL;
    print 'Option: ';
}

function printState(VendingMachine $vendingMachine): void
{
    print 'State: ' . $vendingMachine->getState()->getCode() . PHP_EOL;
    print 'Balance: ' . $vendingMachine->getBalance() . PHP_EOL;
    print 'Coin deposit: ' . formatCoinDeposit($vendingMachine->getCoinDeposit()) . PHP_EOL;
}

function delimiter(): void
{
    print '*********************************************************************' . PHP_EOL;
}

function formatCoinDeposit(CoinDeposit $coinDeposit): string
{
    $str = '';

    /** @var Coin $coin */
    foreach ($coinDeposit->getCoins() as $coin) {
        $str .= $coin->getCode() . '(' . $coin->getQuantity() . ') ';
    }

    $str .= ' - Total: ' . $coinDeposit->getTotalAmount();

    return $str;
}


