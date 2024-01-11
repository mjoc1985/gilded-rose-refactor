<?php

declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Interfaces\ItemInterface;

class ConjuredItem extends BaseItem implements ItemInterface
{
    public function update(): void
    {
        $this->decreaseSellIn();

        $degradationRate = ($this->item->sellIn <= 0) ? 4 : 2;

        $this->decreaseQuality($degradationRate);

        if ($this->item->quality < 0) {
            $this->item->quality = 0;
        }
    }
}
