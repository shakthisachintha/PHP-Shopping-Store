<?php
include_once(__DIR__ . "/../services/EntityService.php");

class ProductService extends EntityService
{
    protected string $table_name = 'product';
    private CategoryService $categoryService;

    function __construct()
    {
        parent::__construct();
        $this->categoryService = new CategoryService();
    }

    public function create_new(array $properties): Product
    {
        $category = $this->categoryService->get_category_by_id($properties['category_id']);

        $product = new Product();
        $product->set_name($properties['name']);
        $product->set_quantity($properties['quantity']);
        $product->set_description($properties['description']);
        $product->set_image($properties['image_url']);
        $product->set_downloadLink($properties['download_link']);
        $product->set_price($properties['price']);
        $product->set_category($category);

        if (isset($properties['id'])) $product->set_id($properties['id']);
        return $product;
    }

    private function create_product_from_record(array $product_arr): Product | NULL
    {
        if (!$product_arr) return NULL;
        else {
            $product = $this->create_new($product_arr);
            return $product;
        }
    }

    public function get_product_by_id(string $id): Product | NULL
    {
        $product_arr = $this->databaseService->retrieve_by_id($this->table_name, $id);
        return $this->create_product_from_record($product_arr);
    }

    public function update_product(array $data): EntityOperationResult
    {
        $is_exist = $this->databaseService->record_exists($this->table_name, $data['product_id']);
        if ($is_exist) {
            $success = $this->databaseService->update_record($this->table_name, [
                'name' => $data['name'],
                'description' => $data['description'],
                'image_url' => $data['image_url'],
                'download_link' => $data['download_link'],
                'category_id' => $data['category_id'],
                'price' => $data['price'],
                'quantity' => $data['quantity']
            ], $data['product_id']);

            $this->categoryService->remove_product_from_category($data['product_id'], $data['category_id']);
            $this->categoryService->add_product_to_category($data['product_id'], $data['category_id']);
            if ($success)
                return new EntityOperationResult(true, "Product '" . $data['name'] . "' has been updated!");
        }
        return new EntityOperationResult(false, "Product update failed!");
    }

    public function create_new_product_from_request(array $data): EntityOperationResult
    {
        $is_exist = $this->databaseService->record_exists_by_field($this->table_name, 'name', $data['name']);
        if ($is_exist) {
            return new EntityOperationResult(false, "Product '" . $data['name'] . "' already exists!");
        }
        $product = $this->create_new($data);
        if ($this->save_to_database($product)) {
            return new EntityOperationResult(true, "Product '" . $product->get_name() . "' successfully created!");
        }
        return new EntityOperationResult(false, "Product creation failed!");
    }

    public function get_all(): array
    {
        $results_arr = array();
        $product_arr = $this->databaseService->retrieve_all_records($this->table_name);
        foreach ($product_arr as $rec) {
            $product = $this->create_product_from_record($rec);
            array_push($results_arr, $product);
        }
        return $results_arr;
    }

    protected function extended_store_db_func(object $product): bool
    {
        $category = $product->get_category();
        return $this->categoryService->add_product_to_category($product->get_id(), $category->get_id());
    }
}
