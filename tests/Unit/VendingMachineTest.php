<?php

namespace tests\Unit;

use App\State\Ready;
use App\VendingMachine;
use PHPUnit\Framework\TestCase;

class VendingMachineTest extends TestCase
{
    private VendingMachine $vendingMachine;

    public function setUp(): void
    {
        $this->vendingMachine = new VendingMachine();
    }

    public function test_vending_machine_gets_properly_constructed()
    {
        $readyState = new Ready($this->vendingMachine);

        $this->assertEquals(0, $this->vendingMachine->getBalance());
        $this->assertEquals($readyState->getCode(), $this->vendingMachine->getState()->getCode());
    }

    public function test_add_to_balance_updates_balance()
    {
        $this->vendingMachine->addToBalance(15.5);
        $this->vendingMachine->addToBalance(5.5);

        $this->assertEquals(21, $this->vendingMachine->getBalance());
    }
}