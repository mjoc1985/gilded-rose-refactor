<?php

declare(strict_types=1);

namespace GildedRose\Interfaces;

interface ItemInterface
{
    public function update(): void;

    public function decreaseSellIn(): void;
}
