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

    public function handle_checkout_payment(array $request)
    {
        $this->OrderService->new_order_from_customer_cart($request['user']->get_id(), $request);
        $this->render('views/pages/checkout/html_payment_index', ["title" => "Order payment"]);
    }
}
