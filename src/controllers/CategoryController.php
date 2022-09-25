<?php
class CategoryController extends BaseController
{
    public function show_create_view()
    {
        $this->render('views/pages/category/html_category_create', ["title" => "Category Create"]);
    }

    public function show_all_category_view()
    {
        $categories = $this->CategoryService->get_all();
        $new_cats = array();
        foreach ($categories as &$cat) {
            $products = $this->ProductService->get_category_products($cat->get_id());
            $cat->add_products($products);
            array_push($new_cats, $cat);
        }
        $this->render('views/pages/category/html_category', ["title" => "All categories", 'new_categories' => $new_cats]);
    }

    public function show_category_products(array $request)
    {
        $products = $this->ProductService->get_category_products($request['category_id']);
        if (count($products) === 0) return RouterService::RedirectWithErrors('shop', ["No products found for the selected grade."]);
        else {
            $category = $this->CategoryService->get_category_by_id($request['category_id']);
            $this->render("views/pages/products/html_category_products", [
                "title" => ucwords($category->get_name() . " - Products"),
                "products" => $products,
                "category" => $category,
            ]);
        }
    }

    public function handle_create(array $request)
    {
        $resp = $this->CategoryService->create_new_category_from_request($request);
        if ($resp->success) return RouterService::RedirectBackWithSuccess($resp->detail);
        else return RouterService::RedirectBackWithErrors([$resp->details]);
    }

    public function handle_update(array $request)
    {
        if (!$this->CategoryService->is_category_exist($request['category_id']))
            RouterService::RedirectWithErrors('categories', ['Category not found!']);
        $success = $this->CategoryService->update_category($request['name'], $request['category_id']);
        if ($success) return RouterService::RedirectBackWithSuccess('Category successfully updated.');
        return  RouterService::RedirectBackWithErrors(['Could not update the category.']);
    }

    public function show_update_view(array $request)
    {
        if (!$this->CategoryService->is_category_exist($request['category_id']))
            RouterService::RedirectWithErrors('categories', ['Category not found!']);
        $category = $this->CategoryService->get_category_by_id($request['category_id']);
        $this->render('views/pages/category/html_category_update', ["title" => "All categories", 'category' => $category]);
    }

    public function handle_category_delete(array $request)
    {
        if (!$this->CategoryService->is_category_exist($request['category_id']))
            RouterService::RedirectWithErrors('categories', ['Category not found!']);
        $products = $this->ProductService->get_category_products($request['category_id']);
        if (count($products) > 0) {
            return  RouterService::RedirectWithErrors('categories', ['Could not delete category, it contains some products.']);
        }
        $success = $this->CategoryService->delete_category($request['category_id']);
        if ($success) return RouterService::RedirectWithSuccess('categories', 'Category successfully deleted.');
        return  RouterService::RedirectWithErrors('categories', ['Could not delete category.']);
    }
}
