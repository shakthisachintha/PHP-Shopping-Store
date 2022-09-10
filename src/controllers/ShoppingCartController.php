<?php
class ShoppingCartController extends BaseController
{
    function __construct()
    {
        parent::__construct();
    }

    public function handle_add_product(array $request)
    {
        $resp = $this->ShoppingCartService->add_product_to_shopping_cart($request['product_id'], $request['user']->get_id());
        if ($resp->success) return RouterService::RedirectBackWithSuccess($resp->details);
        else return RouterService::RedirectBackWithErrors([$resp->details]);
    }

    public function handle_remove_product(array $request)
    {
        $resp = $this->ShoppingCartService->remove_product_from_shopping_cart($request['product_id'], $request['user']->get_id());
        if ($resp->success) return RouterService::RedirectBackWithSuccess($resp->details);
        else return RouterService::RedirectBackWithErrors([$resp->details]);
    }

    public function handle_cart_clear(array $request)
    {
        $resp = $this->ShoppingCartService->clear_customer_cart($request['user']->get_id());
        if ($resp->success) return RouterService::RedirectBackWithSuccess($resp->details);
        else return RouterService::RedirectBackWithErrors([$resp->details]);
    }
}
