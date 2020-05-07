<?php

namespace tests\Unit;

use App\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    public function test_item_gets_properly_constructed()
    {
        $item = new Item('water', 0.50, 5);

        $this->assertEquals('water', $item->getCode());
        $this->assertEquals(0.50, $item->getPrice());
        $this->assertEquals(5, $item->getQuantity());
    }

    public function test_set_quantity_sets_the_value()
    {
        $item = new Item('water', 0.50, 5);
        $item->setQuantity(10);

        $this->assertEquals(10, $item->getQuantity());
    }

    public function test_add_updates_quantity()
    {
        $item = new Item('water', 0.50, 5);
        $item->add(3);

        $this->assertEquals(8, $item->getQuantity());
    }

    public function test_subtract_updates_quantity()
    {
        $item = new Item('water', 0.50, 5);
        $item->subtract(3);

        $this->assertEquals(2, $item->getQuantity());
    }
}