<?php
include_once(__DIR__ . '/Product.php');
include_once(__DIR__ . '/BaseEntity.php');

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

    function add_products(array $products): void
    {
        $this->products= $products;
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

    function attributes_to_array(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
