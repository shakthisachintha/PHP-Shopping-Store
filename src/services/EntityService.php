<?php

class EntityOperationResult
{
    public bool $success;
    public string $details;

    public function __construct(bool $success, string $details)
    {
        $this->success = $success;
        $this->details = $details;        
    }
}

class EntityService
{
    protected DatabaseService $databaseService;

    public function __construct()
    {
        $this->databaseService = new DatabaseService();
    }

    protected function extended_store_db_func(): bool
    {
        return true;
    }

    function save_to_database(object $entity): bool
    {
        $data_arr = $entity->attributes_to_array();
        $res1 = $this->databaseService->create_record($this->table_name, $data_arr);
        $res2 = $this->extended_store_db_func();
        return ($res1 && $res2);
    }
}
