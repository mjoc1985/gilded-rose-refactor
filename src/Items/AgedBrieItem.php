<?php

declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Interfaces\ItemInterface;

class AgedBrieItem extends BaseItem implements ItemInterface
{
    public function update(): void
    {
        $this->decreaseSellIn();

        if ($this->item->quality < 50) {
            $this->increaseQuality(1);
        }
    }
}
