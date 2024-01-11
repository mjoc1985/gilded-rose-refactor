<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Factory\ItemFactory;

final class GildedRose
{
    private array $items;

    /**
     * @param Item[] $items
     */
    public function __construct(array $items)
    {
        $this->items = array_map(fn ($item) => ItemFactory::create($item), $items);
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            $item->decreaseSellIn();
            $item->update();
        }
    }
}
