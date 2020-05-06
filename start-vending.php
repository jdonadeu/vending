<?php

use App\Coin;
use App\VendingMachine;

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

$exit = false;

// Execution
while (!$exit) {
    printState($vendingMachine);
    delimiter();
    menu();

    $handle = fopen("php://stdin", "r");
    $option = trim(fgets($handle));
    fclose($handle);
    echo PHP_EOL;
    delimiter();

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
            case 'r':
                $vendingMachine->returnCoins();
                break;
            default:
                echo 'Invalid option, try again' . PHP_EOL;
        }
    } else {
        $exit = true;
    }
}

// Exit
echo PHP_EOL . PHP_EOL;
delimiter();
echo 'Exit' . PHP_EOL;
delimiter();
echo PHP_EOL;