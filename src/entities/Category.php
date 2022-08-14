<?php
include_once("./Product.php");
include_once("./BaseEntity.php");

class Category extends BaseEntity
{
    private string $name;
    private array $products = array();

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
}
