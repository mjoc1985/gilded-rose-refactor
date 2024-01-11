<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testFoo(): void
    {
        $items = [new Item('foo', 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('foo', $items[0]->name);
    }

    public function testSellInDecreasesAsExpected()
    {
        $items = [
            new Item('Standard Item', 10, 20),
            new Item('Aged Brie', 10, 20),
            new Item('Sulfuras, Hand of Ragnaros', 10, 20),
            new Item('Backstage passes to a TAFKAL80ETC concert', 10, 20),
        ];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        // Decreases by one for standard items
        $this->assertEquals(9, $items[0]->sellIn);
        // Decreases by one for Aged Brie
        $this->assertEquals(9, $items[1]->sellIn);
        // Does not decrease for Sulfuras
        $this->assertEquals(10, $items[2]->sellIn);
        // Decreases by one for Backstage Passes
        $this->assertEquals(9, $items[3]->sellIn);
    }

    public function testStandardItemDecreasesByOne()
    {
        $items = [new Item('Standard Item', 10, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertEquals(9, $items[0]->sellIn);
        $this->assertEquals(19, $items[0]->quality);
    }

    public function testStandardItemDecreasesByTwoAfterSellDate()
    {
        $items = [new Item('Standard Item', 0, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertEquals(-1, $items[0]->sellIn);
        $this->assertEquals(18, $items[0]->quality);
    }

    public function testItemQualityIsNeverNegative()
    {
        $items = [new Item('Standard Item', 10, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertGreaterThanOrEqual(0, $items[0]->quality);
    }

    public function testAgedBrieIncreasesInQuality()
    {
        $items = [new Item('Aged Brie', 10, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertEquals(21, $items[0]->quality);
    }

    public function testItemQualityIsNeverMoreThanFifty()
    {
        $items = [new Item('Aged Brie', 10, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertLessThanOrEqual(50, $items[0]->quality);
    }

    public function testSulfurasNeverQualityNeverChanges()
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', 10, 80)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertEquals(80, $items[0]->quality);
        $this->assertEquals(10, $items[0]->sellIn);
    }

    public function testBackStagePassesQualityIncreases()
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertEquals(21, $items[0]->quality);
        $this->assertEquals(14, $items[0]->sellIn);
    }

    public function testBackStagePassesQualityIncreasesByTwo()
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 10, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertEquals(22, $items[0]->quality);
        $this->assertEquals(9, $items[0]->sellIn);
    }

    public function testBackStatePassesIncreaseByThree()
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertEquals(23, $items[0]->quality);
        $this->assertEquals(4, $items[0]->sellIn);
    }

    public function testBackStagePassesQualityDropsToZeroAfterConcert()
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 0, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertEquals(0, $items[0]->quality);
        $this->assertEquals(-1, $items[0]->sellIn);
    }

    public function testConjuredItemsDegradeTwiceAsFastInQuality()
    {
        $items = [new Item('Conjured Mana Cake', 10, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertEquals(18, $items[0]->quality);
        $this->assertEquals(9, $items[0]->sellIn);
    }

    public function testConjuredItemsDegradeTwiceAsFastInQualityAfterSellDate()
    {
        $items = [new Item('Conjured Mana Cake', 0, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertEquals(16, $items[0]->quality);
    }

    public function testConjuredItemsQualityIsNeverNegative()
    {
        $items = [new Item('Conjured Mana Cake', 10, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertGreaterThanOrEqual(0, $items[0]->quality);
    }
}
