<?php
include_once("./Product.php");
include_once("./User.php");
include_once("./BaseEntity.php");

class ShoppingCart extends BaseEntity
{

    private User $user;
    private array $products = array();


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
}
