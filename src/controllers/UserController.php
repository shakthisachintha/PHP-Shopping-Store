<?php 
class UserController extends BaseController {

    function __construct()
    {
        parent::__construct();
    }
    
    public function show_user_account(){
        echo "User Account Screen";
    }
}