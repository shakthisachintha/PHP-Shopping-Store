<?php
class UserController extends BaseController
{

    function __construct()
    {
        parent::__construct();
    }

    public function show_user_account()
    {
        $user = $this->AuthService->get_current_user();
        $this->render('views/pages/user/html_user_account', ["title" => "My account", "user" => $user]);
    }

    public function show_user_orders()
    {
        $orders = $this->OrderService->get_user_orders($this->AuthService->get_current_user()->get_id());
        $this->render('views/pages/order/html_my_orders', ["title" => "My orders", "orders" => $orders]);
    }

    public function handle_account_update(array $request)
    {
        $resp = $this->AuthService->update_user_details($request['user']->get_id(), $request['name'], $request['address']);
        if ($resp->success) return RouterService::RedirectBackWithSuccess($resp->details);
        else return RouterService::RedirectBackWithErrors([$resp->details]);
    }

    public function handle_password_update(array $request)
    {
        $resp = $this->AuthService->update_user_password($request['user']->get_id(), $request['new_password'], $request['current_password']);
        if ($resp->success) return RouterService::RedirectBackWithSuccess($resp->details);
        else return RouterService::RedirectBackWithErrors([$resp->details]);
    }
}
