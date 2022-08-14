<?php
include_once(__DIR__. '/Product.php');
include_once(__DIR__. '/BaseEntity.php');

class Category extends BaseEntity
{
    protected string $name;
    protected array $products = array();
    protected string $tableName = 'category';

    function __construct()
    {
        parent::__construct();
    }

    function set_name(string $name): void
    {
        $this->name = $name;
    }

    function get_name(): string
    {
        return $this->name;
    }

    function add_products(Product $product): void
    {
        array_push($this->products, $product);
    }

    function get_products(): array
    {
        return $this->products;
    }

    function deleteProduct(Product $product): void
    {
        $pos = array_search($product, $this->products);
        if ($pos !== false) {
            unset($this->products[$pos]);
        }
    }

    function attributes_to_array(): array{
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }

    protected function extended_store_db_func(): bool
    {
        foreach ($this->products as $product) {
            $pd_arr = ["product_id"=>$product->id, "category_id"=>$this->id];
            $res = $this->databaseService->create_record("category_product", $pd_arr);
            if (!$res) return false;
        }
        return true;
    }
}
