<?php

declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Item;

class BaseItem
{
    public Item $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    protected function decreaseSellIn(): void
    {
        --$this->item->sellIn;
    }

    protected function increaseQuality(int $amount): void
    {
        $this->item->quality += $amount;
    }

    protected function decreaseQuality(int $amount): void
    {
        $this->item->quality -= $amount;
    }
}
