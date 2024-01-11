<?php

declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Interfaces\ItemInterface;

class StandardItem extends BaseItem implements ItemInterface
{
    public function update(): void
    {
        $degradationRate = ($this->item->sellIn <= 0) ? 2 : 1;

        $this->decreaseQuality($degradationRate);

        if ($this->item->quality < 0) {
            $this->item->quality = 0;
        }

        $this->decreaseSellIn();
    }
}
