<?php
include_once(__DIR__ . '/Product.php');
include_once(__DIR__ . '/User.php');
include_once(__DIR__ . '/BaseEntity.php');

class ShoppingCart extends BaseEntity
{

    protected string $user_id;
    protected array $products = array();

    function __construct()
    {
        parent::__construct();
    }

    function set_user_id(string $user_id): void
    {
        $this->user_id = $user_id;
    }

    function add_products(Product $product, string $rec_id): void
    {
        array_push($this->products, ['record_id'=>$rec_id, 'product'=>$product]);
    }

    function contains_product(string $product_id): bool
    {
        foreach ($this->products as $data) {
            if ($data['product']->get_id() === $product_id) return true;
        }
        return false;
    }

    function get_user_id(): string
    {
        return $this->user_id;
    }

    function get_products(): array
    {
        return $this->products;
    }

    function attributes_to_array(): array{
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
        ];
    }
}
