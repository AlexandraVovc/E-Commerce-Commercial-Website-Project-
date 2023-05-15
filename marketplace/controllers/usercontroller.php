<?php 
namespace controllers;

require(dirname(__DIR__)."/models/user.php");

class UserController{

    function __construct(){

        if(isset($_GET)){
            if(isset($_GET['action'])){

                $action = $_GET['action'];

                $viewClass = "\\views\\"."User".ucfirst($action);

                $this->user = new \models\User();

                $products = $this->user->getAll();


                if($action == 'login'){
                    if(isset($_POST['email']) && isset($_POST['password']) ){

                        $this->user->setEmail($_POST['email']);
                        $this->user->setPassword($_POST['password']);
                        $this->user = $this->user->getUserByEmail($_POST['email'])[0];

                        $this->user->$action();
                    }
                }else if($action == 'register'){
                    if(isset($_POST['email']) && isset($_POST['password']) ){

                        $this->user->setEmail($_POST['email']);
                        $this->user->setPassword($_POST['password']);
                        $this->user->setFname($_POST['fname']);
                        $this->user->setLname($_POST['lname']);

                        $this->user->$action();
                    }
                }else if($action == 'logout'){
                    $this->user->$action();
                }

                if(class_exists($viewClass)){

                    $view = new $viewClass($this->user);

                    $view->render($products);
                    

                }

            }
    }
    }
}

?>