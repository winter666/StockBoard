<?php


namespace App\Collections;


abstract class AbstractCollectionItem
{
    protected const ATTRIBUTES = [];

    public function __construct(array $data)
    {
        $fields = static::ATTRIBUTES;
        foreach ($fields as $fieldName) {
            if (!str_starts_with($fieldName, '_')) {
                if (!empty($data[$fieldName])) {
                    $this->$fieldName = $data[$fieldName];
                } elseif (isset(static::DEFAULTS[$fieldName])) {
                    $this->$fieldName = static::DEFAULTS[$fieldName];
                }
            }
        }
    }

    public function toArray() {
        $values = [];
        foreach (static::ATTRIBUTES as $field) {
            $values[$field] = $this->$field;
        }

        return $values;
    }
}
