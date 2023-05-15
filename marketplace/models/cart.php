<?php 
namespace models;

require_once(dirname(__DIR__)."/core/dbconnectionmanager.php");

require_once(dirname(__DIR__)."/core/membershipprovider.php");

class Cart{

    private $cart_id;
    private $product_id;
    private $user_id;

    function __construct(){
        $conManager = new \database\DBConnectionManager();

        $this->dbConnection = $conManager->getConnection();

        $this->membershipProvider = new \membershipprovider\MembershipProvider($this);
    }

    // public function getAll($cart_id){
    //     $SQL = "SELECT * FROM cart WHERE cart_id=:cart_id";
    //     $STMT = self::$_connection->prepare($SQL);
    //     $STMT->execute(['cart_id'=>$cart_id]);
    //     $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Cart');
    //     return $STMT->fetchAll();
    // }

    function getAll(){

        $query = "select * from cart";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute();

        return $statement->fetchAll();

    }

    public function getCartByUserId($user_id){
		$SQL = "SELECT * FROM cart inner join product on product.product_id=cart.product_id where user_id=:user_id";
		$STMT = $this->dbConnection->prepare($SQL);
		$STMT->execute(['user_id'=>$user_id]);
		return $STMT->fetchColumn(0);
	}


    public function setId($cart_id){

        $this->id = $id;

    }
   
    public function getId(){

        return $this->id;

    }

}
    
    
?>