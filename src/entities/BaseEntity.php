<?php
include_once(__DIR__ . '/../services/DatabaseService.php');

class BaseEntity
{
    protected string $id;
    protected DatabaseService $databaseService;

    function __construct()
    {
        $this->databaseService = new DatabaseService();
        $this->id = uniqid();
    }

    function get_id(): string
    {
        return $this->id;
    }

    function attributes_to_array(): array
    {
        $attr_array = array();
        foreach ($this as $attr => $value) {
            $type = gettype($value);
            if ($type === 'object') {
                $attr_array[$attr] = $value->value;
                echo "$attr: " . $value->value . "<br>";
            } elseif ($type !== 'array') {
                echo "$attr: $value <br>";
                // $attr_array[$attr] = $value;
            }
        }
        return $attr_array;
    }

    protected function extended_store_db_func(): bool
    {
        return true;
    }

    function save_to_database(): bool
    {
        $data_arr = $this->attributes_to_array();
        $res1 = $this->databaseService->create_record($this->tableName, $data_arr);
        $res2 = $this->extended_store_db_func();
        return ($res1 && $res2);
    }
}
