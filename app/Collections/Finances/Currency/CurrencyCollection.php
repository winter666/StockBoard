<?php


namespace App\Collections\Finances\Currency;


use App\Collections\AbstractCollection;

class CurrencyCollection extends AbstractCollection
{
    protected array $items;

    public function push(array $item) {
        $this->items[] = new CurrencyCollectionItem($item);
    }
}
