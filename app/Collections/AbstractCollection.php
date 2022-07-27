<?php


namespace App\Collections;


use App\Collections\Finances\Currency\CurrencyCollectionItem;

abstract class AbstractCollection
{
    protected array $items;

    public function __construct(array $items) {
        foreach ($items as $item) {
            $this->push($item);
        }
    }

    public function push(array $item) {
        $this->items[] = $item;
    }

    public function get() {
        return $this->items;
    }
}
