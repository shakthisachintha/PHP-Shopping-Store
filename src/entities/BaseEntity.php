<?php

class BaseEntity
{
    protected string $id;

    function __construct()
    {
        $this->id = uniqid();
    }

    function get_id(): string
    {
        return $this->id;
    }

    function iterateAttributes(): array
    {
        $attr_array = array();
        foreach ($this as $attr => $value) {
            $type = gettype($value);
            if ($type === 'object') {
                $attr_array[$attr] = $value->value;
                // echo "$attr: ".$value->value."<br>";
            } else {
                // echo "$attr: $value <br>";
                $attr_array[$attr] = $value;
            }
        }
        return $attr_array;
    }
}
