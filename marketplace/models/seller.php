<?php 
namespace models;

require_once(dirname(__DIR__)."/core/dbconnectionmanager.php");

require(dirname(__DIR__)."/core/membershipprovider.php");

class Seller{
    private $id;
    private $email;
    private $password;
    private $fname;
    private $lname;


    private $dbConnection;
    private $membershipProvider;

    function __construct(){
        $conManager = new \database\DBConnectionManager();

        $this->dbConnection = $conManager->getConnection();

        $this->membershipProvider = new \membershipprovider\MembershipProvider($this);
    }

    function getAll(){

        $query = "select * from product";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute();

        return $statement->fetchAll();

    }

    function login(){

        $verified = false;

        $dbPassword = $this->getPasswordByEmail();

        if(isset($_POST['password'])){
            if(password_verify($_POST['password'], $dbPassword)){
                $verified = true;
            }
        }

        return $verified;
        
    }

    function logout(){

        $this->membershipProvider->logout();

        header('location:index.php?resource=seller&action=login');

    }

    function register(){
        $query = "INSERT INTO seller (email,fname,lname,password_hash) VALUES(:email,:fname,:lname,:password)";

        $statement = $this->dbConnection->prepare($query);

        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        return $statement->execute(['email' => $this->email,'fname' => $this->fname,'lname' => $this->lname,'password'=> $hashedPassword]);

    }

    public function getMembershipProvider(){
        return $this->membershipProvider;
    }

    function getSellerByEmail($email){

        $query = "SELECT * FROM seller WHERE email = :email";

        $statement = $this->dbConnection->prepare($query);
        
        $statement->execute(['email'=> $email]);

        return $statement->fetchAll(\PDO::FETCH_CLASS, Seller::class);    
    }

    function getPasswordByEmail(){

        $query = "SELECT password_hash FROM seller WHERE email = :email";

        $statement = $this->dbConnection->prepare($query);
        
        $statement->execute(['email'=> $this->email]);

        return $statement->fetchColumn(0);
    }

    public function setEmail($email){

        $this->email = $email;

    }
   
    public function getEmail(){

        return $this->email;

    }

    public function setPassword($password){

        $this->password = $password;

    }
    public function getPassword(){

        return $this->password;

    }

    public function setFname($fname){

        $this->fname = $fname;

    }
    public function getFname(){

        return $this->fname;

    }

    public function setLname($lname){

        $this->lname = $lname;

    }
    public function getLname(){

        return $this->lname;

    }
    

    

}

?>