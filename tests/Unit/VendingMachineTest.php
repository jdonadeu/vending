<?php

namespace tests\Unit;

use App\State\ReadyState;
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
        $readyState = new ReadyState($this->vendingMachine);

        $this->assertEquals(0, $this->vendingMachine->getBalance());
        $this->assertEquals($readyState->getCode(), $this->vendingMachine->getState()->getCode());
    }

    public function test_set_balance_updates_balance()
    {
        $this->vendingMachine->setBalance(25.50);

        $this->assertEquals(25.50, $this->vendingMachine->getBalance());
    }

    public function test_set_balance_throws_exception_if_balance_is_negative()
    {
        $this->expectException(\Exception::class);
        $this->vendingMachine->setBalance(-1);
    }

    public function test_add_to_balance_updates_balance()
    {
        $this->vendingMachine->addToBalance(15.5);
        $this->vendingMachine->addToBalance(5.5);

        $this->assertEquals(21, $this->vendingMachine->getBalance());
    }
}