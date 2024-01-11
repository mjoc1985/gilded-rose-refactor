<?php

declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Interfaces\ItemInterface;

class BackStagePassItem extends BaseItem implements ItemInterface
{
    public function update(): void
    {
        if ($this->item->sellIn <= 0) {
            $this->item->quality = 0;
            return;
        }

        if ($this->item->quality < 50) {
            ++$this->item->quality;

            if ($this->item->sellIn <= 10) {
                ++$this->item->quality;
            }

            if ($this->item->sellIn <= 5) {
                ++$this->item->quality;
            }
        }
    }

    public function decreaseSellIn(): void
    {
        --$this->item->sellIn;
    }
}
