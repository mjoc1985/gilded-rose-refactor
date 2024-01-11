<?php

declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Interfaces\ItemInterface;

class ConjuredItem extends BaseItem implements ItemInterface
{
    public function update(): void
    {
        $degradationRate = ($this->item->sellIn <= 0) ? 4 : 2;

        $this->item->quality -= $degradationRate;

        if ($this->item->quality < 0) {
            $this->item->quality = 0;
        }
    }

    public function decreaseSellIn(): void
    {
        --$this->item->sellIn;
    }
}
