<?php
include_once(__DIR__ . "/../services/EntityService.php");

class CategoryService extends EntityService
{
    protected string $table_name = 'category';

    function __construct()
    {
        parent::__construct();
    }


    public function create_new(array $properties)
    {
        $category = new Category();
        $category->set_name($properties['name']);
        if (isset($properties['id'])) $category->set_id($properties['id']);
        return $category;
    }

    private function create_category_from_record(array $category_arr): Category | NULL
    {
        if (!$category_arr) return NULL;
        else {
            $category = $this->create_new($category_arr);
            return $category;
        }
    }

    public function get_category_by_id(string $id): Category | NULL
    {
        $category_arr = $this->databaseService->retrieve_by_id($this->table_name, $id);
        return $this->create_category_from_record($category_arr);
    }

    public function create_new_category_from_request(array $data): EntityOperationResult
    {
        $is_exist = $this->databaseService->record_exists_by_field($this->table_name, 'name', $data['name']);
        if ($is_exist) {
            return new EntityOperationResult(false, "Category '" . $data['name'] . "' already exists!");
        }
        $category = $this->create_new($data);
        if ($this->save_to_database($category)) {
            return new EntityOperationResult(true, "Category '" . $category->get_name() . "' successfully created!");
        }
        return new EntityOperationResult(false, "Category creation failed!");
    }

    public function get_all(): array
    {
        $results_arr = array();
        $category_arr = $this->databaseService->retrieve_all_records($this->table_name);
        foreach ($category_arr as $rec) {
            $category = $this->create_category_from_record($rec);
            array_push($results_arr, $category);
        }
        return $results_arr;
    }

    public function get_category_by_name(string $name): Category | NULL
    {
        $category_arr = $this->databaseService->retrieve_by_field($this->table_name, 'name', $name);
        //@ todo add products array to the category
        return $this->create_category_from_record($category_arr);
    }
}
