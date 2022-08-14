<?php

class BaseEntity {
    protected string $id;
    protected string $tableName;

    function set_id(string $id): void
    {
        $this->id = $id;
    }

    function get_id(): string
    {
        return $this->id;
    }
}