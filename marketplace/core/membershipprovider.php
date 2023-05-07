<?php 
namespace membershipprovider;

class MemberShipProvider{
    private $user;

    function __construct($user){
        $this->user = $user;
    }

    function login(){

        session_name("marketplace");

        session_start();
        
        $_SESSION['email'] = $this->user->getEmail();
        $_SESSION['fname'] = $this->user->getFname();
        
        setcookie('marketplaceuser', $this->user->getEmail(), time()+3600);
        setcookie('marketplacefname', $this->user->getFname(), time()+3600);
        
    }

    function logout(){

        $_SESSION = array();

        session_destroy ();

        setcookie('marketplaceuser', $this->user->getEmail(), time()-3600);
        setcookie('marketplacefname', $this->user->getFname(), time()-3600);

    }

}
?>