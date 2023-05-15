<?php 
namespace membershipprovider;

class MemberShipProvider{
    private $user;

    function __construct($user){
        $this->user = $user;
    }

    function userLogin(){

        session_name("marketplace");

        session_start();
        
        $_SESSION['email'] = $this->user->getEmail();
        $_SESSION['userfname'] = $this->user->getFname();
        
        setcookie('user', $this->user->getEmail(), time()+3600);
        setcookie('userfname', $this->user->getFname(), time()+3600);
        
    }
    // function sellerLogin(){

    //     session_name("marketplace");

    //     session_start();
        
    //     $_SESSION['email'] = $this->seller->getEmail();
    //     $_SESSION['sellerfname'] = $this->seller->getFname();
        
    //     setcookie('seller', $this->seller->getEmail(), time()+3600);
    //     setcookie('sellerfname', $this->seller->getFname(), time()+3600);
        
    // }

    function logout(){

        $_SESSION = array();

        session_destroy ();

        setcookie('user', $this->user->getEmail(), time()-3600);
        setcookie('userfname', $this->user->getFname(), time()-3600);

        // setcookie('seller', $this->seller->getEmail(), time()-3600);
        // setcookie('sellerfname', $this->seller->getFname(), time()-3600);

    }
    

}