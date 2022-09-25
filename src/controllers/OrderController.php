<?php
class OrderController extends BaseController
{
    function __construct()
    {
        parent::__construct();
    }

    public function show_checkout_page(array $request)
    {
        $cart = $this->ShoppingCartService->get_customer_shopping_cart($request['user']->get_id());
        $total = 0;
        foreach ($cart->get_products() as $prod) {
            $total += $prod['product']->get_price();
        }
        $this->render('views/pages/checkout/html_checkout_index', ["title" => "Order checkout", "total" => $total]);
    }

    public function handle_create_order_and_checkout(array $request)
    {
        $order = $this->OrderService->new_order_from_customer_cart($request['user']->get_id(), $request);
        if (!$order) return RouterService::RedirectBackWithSuccess("Order creation failed, try again later.");
        else {
            RouterService::Redirect(build_route_get('checkout-payment', ["order_id" => $order->get_id()]));
        }
    }

    public function show_checkout_payment_gateway(array $request)
    {
        $order = $this->OrderService->get_order_by_id($request['order_id']);
        $this->render('views/pages/checkout/html_payment_index', ["title" => "Order payment", "order" => $order]);
    }

    public function handle_payment_status_update(array $request)
    {
        $this->OrderService->update_payment_status($request['order_id'], $request['payment_status']);
        return RouterService::Redirect(build_route_get('orders', ["order_id" => $request['order_id']]));
    }

    public function show_order_details(array $request)
    {
        $order = $this->OrderService->get_order_by_id($request['order_id']);
        $this->render('views/pages/order/html_order_index', ["title" => "Order details", "order" => $order]);
    }

    public function show_admin_order_page(array $request)
    {
        $orders = $this->OrderService->get_all_orders();
        $this->render('views/pages/order/html_my_orders', ["title" => "Orders", "orders" => $orders]);
    }

    public function handle_mark_order_shipped(array $request)
    {
        $this->OrderService->update_order_status($request['order_id'], 'shipped');
        return RouterService::Redirect(build_route_get('orders', ["order_id" => $request['order_id']]));
    }

    public function handle_order_product_download(array $request)
    {
        $product = $this->ProductService->get_product_by_id($request['product_id']);
        $url = $product->get_downloadLink();
        header("Location: $url", true, 301);
        exit();
    }
}
