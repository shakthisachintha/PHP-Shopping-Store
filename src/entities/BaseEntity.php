<?php
include_once(__DIR__ . '/../services/DatabaseService.php');

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
}
