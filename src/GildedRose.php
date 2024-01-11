<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * @param Item[] $items
     */
    public function __construct(
        private array $items
    ) {
    }

    public function updateQuality(): void
    {
        foreach($this->items as $item) {
            if ($item->name !== 'Sulfuras, Hand of Ragnaros') {
                $this->updateSellIn($item);
                $this->updateItemQuality($item);
            }
        }
    }

    private function updateItemQuality(Item $item)
    {
        match ($item->name) {
            'Aged Brie' => $this->updateAgedBrieQuality($item),
            'Backstage passes to a TAFKAL80ETC concert' => $this->updateBackstagePassesQuality($item),
            'Sulfuras, Hand of Ragnaros' => null,
            default => $this->updateStandardItemQuality($item),
        };

        if ($item->sellIn < 0) {
            $this->updateExpiredItemQuality($item);
        }

    }

    private function updateSellIn(Item $item)
    {
        $item->sellIn--;
    }

    private function updateStandardItemQuality(Item $item)
    {
        if ($item->quality > 0) {
            $item->quality--;
        }
    }

    private function updateAgedBrieQuality(Item $item)
    {
        if ($item->quality < 50) {
            $item->quality++;
        }
    }

    private function updateBackstagePassesQuality(Item $item)
    {
        if ($item->quality < 50) {
            $item->quality++;

            if ($item->sellIn < 11) {
                $item->quality++;
            }

            if ($item->sellIn < 6) {
                $item->quality++;
            }
        }
    }

    private function updateExpiredItemQuality(Item $item)
    {
        match($item->name) {
            'Aged Brie' => $this->updateAgedBrieQuality($item),
            'Backstage passes to a TAFKAL80ETC concert' => $item->quality = 0,
            'Sulfuras, Hand of Ragnaros' => null,
            default => $this->updateStandardItemQuality($item),
        };
    }


}
