<?php
namespace views;

class SellerLogout{

    private $seller;

    function __construct($seller){

        $this->seller = $seller;

        $this->seller->getMembershipProvider()->logout();

        header('Location:index.php?resource=seller&action=login');
    }
}
?>