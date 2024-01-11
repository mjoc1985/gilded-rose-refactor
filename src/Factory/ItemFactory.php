<?php

declare(strict_types=1);

namespace GildedRose\Factory;

use GildedRose\Interfaces\ItemInterface;
use GildedRose\Item;
use GildedRose\Items\AgedBrieItem;
use GildedRose\Items\BackStagePassItem;
use GildedRose\Items\ConjuredItem;
use GildedRose\Items\StandardItem;
use GildedRose\Items\SulfurasItem;

class ItemFactory
{
    public static function create(Item $item): ItemInterface
    {
        return match ($item->name) {
            'Aged Brie' => new AgedBrieItem($item),
            'Backstage passes to a TAFKAL80ETC concert' => new BackStagePassItem($item),
            'Sulfuras, Hand of Ragnaros' => new SulfurasItem($item),
            'Conjured Mana Cake' => new ConjuredItem($item),
            default => new StandardItem($item),
        };
    }
}
