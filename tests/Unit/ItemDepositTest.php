<?php

namespace tests\Unit;

use \App\Coin;
use App\CoinSet;
use App\Item;
use App\ItemDeposit;
use PHPUnit\Framework\TestCase;

class ItemDepositTest extends TestCase
{
    private ItemDeposit $itemDeposit;

    public function setUp(): void
    {
        $this->itemDeposit = new ItemDeposit();
        $this->itemDeposit->addItem(new Item('water', 0.65));
        $this->itemDeposit->addItem(new Item('juice', 1.00));
        $this->itemDeposit->addItem(new Item('soda', 1.50));
    }

    public function test_add_item_actually_adds_the_item()
    {
        $item = new Item('new-item', 0.65);
        $this->itemDeposit->addItem($item);

        $this->assertEquals($item, $this->itemDeposit->getItem('new-item'));
    }
}