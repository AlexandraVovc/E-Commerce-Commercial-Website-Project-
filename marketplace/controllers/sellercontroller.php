<?php 
namespace controllers;

require(dirname(__DIR__)."/models/seller.php");

class SellerController{

    function __construct(){

        if(isset($_GET)){
            if(isset($_GET['action'])){

                $action = $_GET['action'];

                $viewClass = "\\views\\"."Seller".ucfirst($action);

                $this->seller = new \models\Seller();

                $products = $this->seller->getAll();

                if($action == 'login'){
                    if(isset($_POST['email']) && isset($_POST['password']) ){

                        $this->seller->setEmail($_POST['email']);
                        $this->seller->setPassword($_POST['password']);
                        $this->seller = $this->seller->getSellerByEmail($_POST['email'])[0];

                        $this->seller->$action();
                    }
                }else if($action == 'register'){
                    if(isset($_POST['email']) && isset($_POST['password']) ){

                        $this->seller->setEmail($_POST['email']);
                        $this->seller->setPassword($_POST['password']);
                        $this->seller->setFname($_POST['fname']);
                        $this->seller->setLname($_POST['lname']);

                        $this->seller->$action();
                    }
                }else if($action == 'logout'){
                    $this->seller->$action();
                }

                if(class_exists($viewClass)){

                    $view = new $viewClass($this->seller);

                    $view->render($products);

                }

            }
    }
    }
}

?>