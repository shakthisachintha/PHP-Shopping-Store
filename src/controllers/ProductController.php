<?php
class ProductController extends BaseController
{
    function __construct()
    {
        parent::__construct();
    }

    public function show_index()
    {
        $prod_arr = $this->ProductService->get_all();
        $this->render('views/pages/products/html_products', ["title" => "Products", "products" => $prod_arr]);
    }

    public function show_create_view()
    {
        $cat_arr = $this->CategoryService->get_all();
        $this->render('views/pages/products/html_product_create', ["title" => "Product Create", "categories" => $cat_arr]);
    }

    public function handle_create(array $request)
    {
        $resp = $this->ProductService->create_new_product_from_request($request);
        if ($resp->success) return RouterService::RedirectBackWithSuccess($resp->details);
        else return RouterService::RedirectBackWithErrors([$resp->details]);
    }

    public function show_product_view(array $request)
    {
        $cat_arr = $this->CategoryService->get_all();
        $product = $this->ProductService->get_product_by_id($request["product_id"]);
        $this->render('views/pages/products/html_product_update', ["title" => "Product Details", "categories" => $cat_arr, "product" => $product]);
    }

    public function handle_product_update(array $request)
    {
        $resp = $this->ProductService->update_product($request);
        if ($resp->success) return RouterService::RedirectBackWithSuccess($resp->details);
        else return RouterService::RedirectBackWithErrors([$resp->details]);
    }

    public function handle_product_delete(array $request)
    {
        echo "prodcut delete feature will be implemented in the next iteration.";
    }

    public function show_shop_view()
    {
        $prod_arr = $this->ProductService->get_all();
        $this->render('views/pages/products/html_shop', ["title" => "Shop", "products" => $prod_arr]);
    }
}
