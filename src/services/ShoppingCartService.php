<?php
include_once(__DIR__ . "/../services/EntityService.php");
include_once(__DIR__ . "/../entities/ShoppingCart.php");

class ShoppingCartService extends EntityService
{
    protected string $table_name = 'shoppingcart_product';
    private ProductService $ProductService;

    function __construct()
    {
        parent::__construct();
        $this->ProductService = new ProductService();
    }

    public function get_empty_shopping_cart(): ShoppingCart
    {
        $shopping_cart = new ShoppingCart();
        return $shopping_cart;
    }

    public function get_customer_shopping_cart(string $customer_id): ShoppingCart
    {
        $shopping_cart = new ShoppingCart();
        $shopping_cart->set_user_id($customer_id);
        $cart_products = $this->databaseService->get_filtered_records($this->table_name, ['user_id' => $customer_id]);
        foreach ($cart_products as $prod_rec) {
            $product = $this->ProductService->get_product_by_id($prod_rec['product_id']);
            if ($product) $shopping_cart->add_products($product, $prod_rec['id']);
        }
        return $shopping_cart;
    }

    public function add_product_to_shopping_cart(string $product_id, string $customer_id): EntityOperationResult
    {
        $success = $this->databaseService->create_record($this->table_name, ['id' => uniqid(), 'user_id' => $customer_id, 'product_id' => $product_id]);
        if ($success) return new EntityOperationResult(true, "Product added to shopping cart!");
        return new EntityOperationResult(false, "Could not add the product to shopping cart!");
    }

    public function remove_product_from_shopping_cart(string $product_id, string $customer_id): EntityOperationResult
    {
        $cart_product = $this->databaseService->get_filtered_records($this->table_name, ['user_id' => $customer_id, 'product_id' => $product_id])[0];
        $success = $this->databaseService->delete_by_id($this->table_name, $cart_product['id']);
        if ($success) return new EntityOperationResult(true, "Product removed from shopping cart!");
    }

    public function clear_customer_cart(string $customer_id): EntityOperationResult
    {
        $cart_products = $this->databaseService->get_filtered_records($this->table_name, ['user_id' => $customer_id]);
        foreach ($cart_products as $cart_product) {
            $success = $this->databaseService->delete_by_id($this->table_name, $cart_product['id']);
            if (!$success) return new EntityOperationResult(true, "Shopping cart not cleared!");
        }
        if ($success) return new EntityOperationResult(true, "Shopping cart cleared!");
    }
}
