<?php
class CategoryController extends BaseController
{
    public function show_create_view()
    {
        $this->render('views/pages/category/html_category_create', ["title" => "Category Create"]);
    }
    public static function show_category_view()
    {
        echo 'category - show_category_view';
    }
    public static function show_update_view()
    {
        echo 'category - show_update_view';
    }
    public static function show_delete_view()
    {
        echo 'category - show_delete_view';
    }
    public function handle_create(array $request)
    {
        $resp = $this->CategoryService->create_new_category_from_request($request);
        if ($resp->success) return RouterService::RedirectBackWithSuccess($resp->details);
        else return RouterService::RedirectBackWithErrors([$resp->details]);
    }
    public static function handle_update()
    {
        echo 'category - handle_update';
    }
    public static function handle_delete()
    {
        echo 'category - handle_delete';
    }
}
