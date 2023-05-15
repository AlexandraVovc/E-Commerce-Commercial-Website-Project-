<?php 
namespace controllers;

require(dirname(__DIR__)."/models/cart.php");

class CartController{

    function __construct(){

        if(isset($_GET)){
            if(isset($_GET['action'])){

                $action = $_GET['action'];

                $viewClass = "\\views\\"."Cart".ucfirst($action);

                $this->cart = new \models\Cart();

                $products = $this->cart->getAll();
                // $products = $this->cart->getCartByUserId($_COOKIE['user']);

                

                if(class_exists($viewClass)){

                    $view = new $viewClass($this->user);

                    $view->render($products);
                    

                }

            }
    }
    }
}

?>