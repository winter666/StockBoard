<?php


namespace App\Collections\Finances\Currency;


use App\Collections\AbstractCollectionItem;

/**
 * Class CurrencyCollectionItem
 * @package App\Collections\Finances\Currency
 * @property string $name
 * @property string $external_id
 * @property string $number_code
 * @property string $char_code
 * @property double $nominal
 * @property double $value
 */
class CurrencyCollectionItem extends AbstractCollectionItem
{
    protected const ATTRIBUTES = [
        'name', 'external_id',
        'number_code', 'char_code',
        'nominal', 'value'
    ];

    protected const DEFAULTS = [
        'name' => 'Забугор',
    ];
}
