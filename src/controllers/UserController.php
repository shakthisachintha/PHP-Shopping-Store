<?php 
class UserController extends BaseController {

    function __construct()
    {
        parent::__construct();
    }
    
    public function show_user_account(){
        $user = $this->AuthService->get_current_user();
        $this->render('views/pages/user/html_user_account', ["title" => "My account", "user"=>$user]);
    }

    public function show_user_orders(){
        $orders = $this->OrderService->get_user_orders($this->AuthService->get_current_user()->get_id());
        $this->render('views/pages/order/html_my_orders', ["title" => "My orders", "orders"=>$orders]);
    }
}