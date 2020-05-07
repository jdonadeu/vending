<?php

use App\Coin;
use App\Item;
use App\VendingMachine;
use \App\State\ReadyState;
use \App\State\ServiceState;

require 'vendor/autoload.php';
require 'helpers.php';

// Start
system('clear');
echo PHP_EOL . PHP_EOL;
delimiter();
echo 'Vending machine starting' . PHP_EOL;
delimiter();
echo PHP_EOL;

// Bootstrap
$vendingMachine = new VendingMachine();

$vendingMachine->getCoinDeposit()->addCoin(new Coin('0.05'));
$vendingMachine->getCoinDeposit()->addCoin(new Coin('0.10'));
$vendingMachine->getCoinDeposit()->addCoin(new Coin('0.25'));
$vendingMachine->getCoinDeposit()->addCoin(new Coin('1.00'));

$vendingMachine->getItemDeposit()->addItem(new Item('water', 0.65));
$vendingMachine->getItemDeposit()->addItem(new Item('juice', 1.00));
$vendingMachine->getItemDeposit()->addItem(new Item('soda', 1.50));

$exit = false;

// Execution
while (!$exit) {
    printState($vendingMachine);
    delimiter();

    if ($vendingMachine->getState()->getCode() === 'READY') {
        mainMenu();
    } elseif ($vendingMachine->getState()->getCode() === 'SERVICE') {
        serviceMenu();
    }

    $handle = fopen("php://stdin", "r");
    $option = trim(fgets($handle));
    fclose($handle);
    echo PHP_EOL;
    delimiter();

    if ($vendingMachine->getState()->getCode() === 'READY') {
        if ($option !== 'x') {
            switch ($option) {
                case '1':
                    $vendingMachine->insertCoin('0.05');
                    break;
                case '2':
                    $vendingMachine->insertCoin('0.10');
                    break;
                case '3':
                    $vendingMachine->insertCoin('0.25');
                    break;
                case '4':
                    $vendingMachine->insertCoin('1.00');
                    break;
                case '5':
                    $vendingMachine->buy('water');
                    break;
                case '6':
                    $vendingMachine->buy('juice');
                    break;
                case '7':
                    $vendingMachine->buy('soda');
                    break;
                case 'r':
                    $vendingMachine->returnCoins();
                    break;
                case 's':
                    $vendingMachine->setState(new ServiceState($vendingMachine));
                    break;
                default:
                    echo 'Invalid option, try again' . PHP_EOL;
            }

            delimiter();
        } else {
            $exit = true;
        }
    } elseif ($vendingMachine->getState()->getCode() === 'SERVICE') {
        if ($option !== 'x') {
            switch ($option) {
                case '1':
                    $vendingMachine->replenishCoin('0.05');
                    break;
                case '2':
                    $vendingMachine->replenishCoin('0.10');
                    break;
                case '3':
                    $vendingMachine->replenishCoin('0.25');
                    break;
                case '4':
                    $vendingMachine->replenishCoin('1.00');
                    break;
                case '5':
                    $vendingMachine->replenishItem('water');
                    break;
                case '6':
                    $vendingMachine->replenishItem('juice');
                    break;
                case '7':
                    $vendingMachine->replenishItem('soda');
                    break;
                default:
                    echo 'Invalid option, try again' . PHP_EOL;
            }

            delimiter();
        } else {
            $vendingMachine->setState(new ReadyState($vendingMachine));
        }
    }
}

// Exit
echo PHP_EOL . PHP_EOL;
delimiter();
echo 'Exit' . PHP_EOL;
delimiter();
echo PHP_EOL;