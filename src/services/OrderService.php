<?php

class OrderService extends EntityService
{
    protected string $table_name = 'orders';
    private ShoppingCartService $shoppingCartService;
    private ProductService $productService;
    private UserService $userService;

    function __construct()
    {
        parent::__construct();
        $this->shoppingCartService = new shoppingCartService();
        $this->productService = new ProductService();
        $this->userService = new UserService();
    }

    private function create_new(array $properties): Order
    {
        $order = new Order();
        $status = $properties['status'] === "new" ? OrderStatus::New : ($properties['status'] === "completed" ? OrderStatus::Completed : OrderStatus::Shipped);
        $order_type = $properties['type'] === 'online' ? OrderType::Online : OrderType::Delivery;
        $payment_method = $properties['payment_method'] === 'card' ? PaymentMethod::Card : PaymentMethod::CashOnDelivery;
        $payment_status = $properties['payment_status'] === 'complete' ? PaymentStatus::Complete : PaymentStatus::Incomplete;

        $order->set_status($status);
        $order->set_amount($properties['amount']);
        $order->set_type($order_type);
        $order->set_user($properties['user']);
        $order->set_payment_method($payment_method);
        $order->set_products($properties['products']);
        $order->set_payment_status($payment_status);
        if (isset($properties['id'])) $order->set_id($properties['id']);
        return $order;
    }

    private function create_order_from_record(array $order_arr): Order | NULL
    {
        if (!$order_arr) return NULL;
        else {
            $order_products = $this->get_order_products_array($order_arr['id']);
            $order_arr['products'] = $order_products;

            $order_user = $this->userService->get_user_by_id($order_arr['user_id']);
            $order_arr['user'] = $order_user;

            $order = $this->create_new($order_arr);
            return $order;
        }
    }

    private function get_order_products_array(string $id): array
    {
        $products_array = array();
        $order_products = $this->databaseService->retrieve_by_field('order_product', 'order_id', $id);
        foreach ($order_products as $order_product) {
            $product = $this->productService->get_product_by_id($order_product['product_id']);
            array_push($products_array, $product);
        }
        return $products_array;
    }

    public function get_order_by_id(string $id): Order | NULL
    {
        $order_arr = $this->databaseService->retrieve_by_id($this->table_name, $id);
        return $this->create_order_from_record($order_arr);
    }

    public function new_order_from_customer_cart(string $customer_id, array $request): Order | NULL
    {
        $cart = $this->shoppingCartService->get_customer_shopping_cart($customer_id);
        $products_array = array();
        $amount = 0;
        foreach ($cart->get_products() as $prod_data) {
            $amount += $prod_data['product']->get_price();
            array_push($products_array, $prod_data['product']);
        }
        $order_user = $this->userService->get_user_by_id($customer_id);
        $order_type = $request['order_type'];
        $order_pay_type = $request['payment_method'];
        $order_status = 'new';
        $order_properties = [
            "products" => $products_array,
            "amount" => $amount,
            "status" => $order_status,
            "type" => $order_type,
            "payment_method" => $order_pay_type,
            "user" => $order_user,
            "payment_status" => PaymentStatus::Incomplete
        ];
        $order = $this->create_new($order_properties);
        if ($this->save_to_database($order)) return $order;
        else return NULL;
    }

    public function get_user_orders(string $user_id): array
    {
        $orders_recs = $this->databaseService->retrieve_by_field($this->table_name, 'user_id', $user_id);
        $orders = array();
        foreach ($orders_recs as $order_rec) {
            $order = $this->get_order_by_id($order_rec['id']);
            array_push($orders, $order);
        }
        return $orders;
    }

    public function update_payment_status(string $order_id, string $payment_status)
    {
        $order = $this->get_order_by_id($order_id);
        $data = ['payment_status' => $payment_status];
        if ($order->get_type() === OrderType::Online && $payment_status === 'complete') {
            $data = ['payment_status' => $payment_status, "status" => OrderStatus::Completed->value];
        }
        if ($payment_status === 'complete')
            $success = $this->databaseService->update_record($this->table_name, $data, $order_id);
        if ($success) return new EntityOperationResult(TRUE, "");
        else return new EntityOperationResult(FALSE, "");
    }

    protected function extended_store_db_func(object $order): bool
    {
        // save order products to database
        $order_id = $order->get_id();
        foreach ($order->get_products() as $product) {
            $success = $this->databaseService->create_record(
                "order_product",
                [
                    'id' => uniqid(),
                    'order_id' => $order_id,
                    'product_id' => $product->get_id()
                ]
            );
            if (!$success) return false;
        }

        // remove the current shopping cart items from customer cart
        $res = $this->shoppingCartService->clear_customer_cart($order->get_user()->get_id());
        return $res->success;
    }
}
