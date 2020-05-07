<?php

namespace App\State;

interface VendingMachineState {
    public function getCode(): string;
    public function insertCoin(string $code): void;
    public function returnCoins(): void;
    public function buy(string $itemCode): void;
}