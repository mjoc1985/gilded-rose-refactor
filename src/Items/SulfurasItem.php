<?php

declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Interfaces\ItemInterface;

class SulfurasItem extends BaseItem implements ItemInterface
{
    public function update(): void
    {
        // No change allowed.
    }

    public function decreaseSellIn(): void
    {
        // No change allowed.
    }
}
