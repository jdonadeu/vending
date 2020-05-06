<?php

namespace App;

use App\Exceptions\NotEnoughCoinsException;

class Coin
{
    private string $code;
    private float $value;
    private int $quantity;

    public function __construct(string $code, int $quantity = 0)
    {
        $this->code = $code;
        $this->value = (float) $code;
        $this->quantity = $quantity;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getValue(): float
    {
        return $this->value;
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
            throw new NotEnoughCoinsException();
        }

        $this->quantity -= $quantity;

        return $this;
    }

    public function getTotalAmount(): float
    {
        return $this->getValue() * $this->getQuantity();
    }
}
