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

                $products = $this->cart->getAll('id');

                if($action == 'cart'){

                    $this->cart->getCartByUserId('user_id');

                }else if($action == 'addToCart'){

                	if(isset($_POST['product_id']) && isset($_POST['user_id']) ){

                        $this->cart->setProductId($_POST['product_id']);
                        $this->cart->setUserId($_POST['user_id']);

                        $this->cart->$action();
                    }

                }else if($action == 'deleteFromCart'){
                    $this->cart->delete($_SESSION['cart_id'], $_SESSION['user_id']);
                }

                if(class_exists($viewClass)){

                    $view = new $viewClass($this->cart);

                    $view->render($products);      
                }

            }
    }
    }
}

?>