<?php

declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Interfaces\ItemInterface;

class BackStagePassItem extends BaseItem implements ItemInterface
{
    public function update(): void
    {
        $this->decreaseSellIn();

        if ($this->item->sellIn <= 0) {
            $this->item->quality = 0;
            return;
        }

        if ($this->item->quality < 50) {
            $increaseRate = 1;

            if ($this->item->sellIn <= 10) {
                $increaseRate++;
            }

            if ($this->item->sellIn <= 5) {
                $increaseRate++;
            }

            $this->increaseQuality($increaseRate);
        }
    }
}
