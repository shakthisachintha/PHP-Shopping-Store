<?php 
class UserController extends BaseController {

    function __construct()
    {
        parent::__construct();
    }
    
    public function show_user_account(){
        echo "User Account Screen";
    }

    public function show_user_orders(){
        $orders = $this->OrderService->get_user_orders($this->AuthService->get_current_user()->get_id());
        $this->render('views/pages/order/html_my_orders', ["title" => "My orders", "orders"=>$orders]);
    }
}