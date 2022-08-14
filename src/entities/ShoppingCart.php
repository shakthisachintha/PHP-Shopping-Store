<?php
include_once(__DIR__ . '/Product.php');
include_once(__DIR__ . '/User.php');
include_once(__DIR__ . '/BaseEntity.php');

class ShoppingCart extends BaseEntity
{

    protected User $user;
    protected array $products = array();
    protected string $tableName = 'shoppingcart';

    function __construct()
    {
        parent::__construct();
    }

    function set_user(User $user): void
    {
        $this->user = $user;
    }

    function add_products(Product $product): void
    {
        array_push($this->products, $product);
    }

    function get_user(): User
    {
        return $this->user;
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
            'user_id' => $this->user->id,
        ];
    }

    protected function extended_store_db_func(): bool
    {
        foreach ($this->products as $product) {
            $pd_arr = ["product_id"=>$product->id, "shoppingcart_id"=>$this->id];
            $res = $this->databaseService->create_record("shoppingcart_product", $pd_arr);
            if (!$res) return false;
        }
        return true;
    }
}
