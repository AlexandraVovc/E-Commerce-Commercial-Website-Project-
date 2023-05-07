<?php 
namespace models;

require_once(dirname(__DIR__)."/core/dbconnectionmanager.php");

require(dirname(__DIR__)."/core/membershipprovider.php");

class Cart{

	private $id;
    private $product_id;
    private $user_id;

    private $dbConnection;
    private $membershipProvider;

    function __construct(){
        $conManager = new \database\DBConnectionManager();

        $this->dbConnection = $conManager->getConnection();

        $this->membershipProvider = new \membershipprovider\MembershipProvider($this);
    }

    public function setProductId($product_id){

        $this->product_id = $product_id;

    }
    public function getProductId(){

        return $this->product_id;

    }

    public function setUserId($user_id){

        $this->user_id = $user_id;

    }
    public function getUserId(){

        return $this->user_id;

    }

    public function getMembershipProvider(){
        return $this->membershipProvider;
    }

    public function getCartByUserId($user_id){

		$query = "SELECT * FROM cart inner join product on product.product_id=cart.product_id where user_id=:user_id";

		$statement = $this->dbConnection->prepare($query);

		$statement->execute(['user_id'=>$user_id]);
		
		return $statement->fetchAll();
	}

	public function getAll($cart_id){

		$query = "select * from cart where cart_id=:cart_id";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute(['cart_id'=>$cart_id]);

        return $statement->fetchAll();

    }

	public function insertToCart(){

		$query = "INSERT INTO cart(product_id,user_id) VALUES (:product_id,:user_id)";

        $statement = $this->dbConnection->prepare($query);

        return $statement->execute(['product_id' => $this->product_id, 'user_id' => $this->user_id,]);
	}

	public function delete($cart_id,$user_id){

		$query = "DELETE FROM cart WHERE cart_id=:cart_id and user_id=:user_id";

		$statement = $this->dbConnection->prepare($query);

		return $statement->execute(['cart_id'=>$cart_id, 'user_id'=>$user_id]);
	}


}
?>