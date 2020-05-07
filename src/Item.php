<?php

namespace App;

use App\Exceptions\NotEnoughItemsException;

class Item
{
    private string $code;
    private float $price;
    private int $quantity;

    public function __construct(string $code, float $price, int $quantity = 0)
    {
        $this->code = $code;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function add(int $quantity): self
    {
        $this->quantity += $quantity;

        return $this;
    }

    public function subtract(int $quantity): self
    {
        if ($quantity > $this->quantity) {
            throw new NotEnoughItemsException();
        }

        $this->quantity -= $quantity;

        return $this;
    }
}
