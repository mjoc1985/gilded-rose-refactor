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
}
