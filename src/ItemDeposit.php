<?php

namespace App;

class ItemDeposit
{
    private array $items = [];

    public function getItems(): array
    {
        return $this->items;
    }

    public function getItem(string $code): ?Item
    {
        if (!isset($this->items[$code])) {
            return null;
        }

        return $this->items[$code];
    }

    public function addItem(Item $item): void
    {
        $this->items[$item->getCode()] = $item;
    }
}
