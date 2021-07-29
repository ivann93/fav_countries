<?php
require_once('DbClass.php');

// user auth class
// provide user sigun, login, profile, leased laptop info

class UserAuthClass extends DbClass {

    public $errorMsg = '';

    public function __construct() {
        // get connected to database by parent constructor
        parent::__construct();
    }

    // login method
    // it will store using authentication in session variables
    public function login($email, $password){
        $sql ="SELECT id, name, email, password FROM users WHERE email=:email";
        $query= $this->dbh->prepare($sql);
        $query-> bindParam(':email', $email, PDO::PARAM_STR);
        $query-> execute();
       $results=$query->fetchAll(PDO::FETCH_OBJ);

        if(password_verify($password, $results[0]->password)){
            $_SESSION['loggedIn']= $email;
            $_SESSION['username']= $results[0]->name;
            $_SESSION['userId']= $results[0]->id;
            return true;
        } else{
            $this->errorMsg = "Email or password incorrect";
            return false;
        }

    }


    // signup method
    // signoup method will create new user and also add laptop and lease information
    // this method also create session variable to store user session
    public function signup(
        $name,
        $gender,
        $email,
        $password,
        $confirmPassword
    ){
        $password = password_hash($password, PASSWORD_DEFAULT);

        if($this->checkIfEmailAlreadyRegistered($email)){
            $this->errorMsg = "Email already exists";
            return false;
        }

        $sql="INSERT INTO  users(name, password, gender, email) VALUES(:name, :password, :gender, :email)";
        $query = $this->dbh->prepare($sql);
        $query->bindParam(':name',$name,PDO::PARAM_STR);
        $query->bindParam(':password',$password,PDO::PARAM_STR);
        $query->bindParam(':gender',$gender,PDO::PARAM_STR);
        $query->bindParam(':email',$email,PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $this->dbh->lastInsertId();
        if($lastInsertId) {
            $_SESSION['loggedIn']= $email;
            $_SESSION['username']= $name;
            $_SESSION['userId']= $lastInsertId;

            return true;
        } else{
            $this->errorMsg = "Failed to register";
            return false;
        }

    }

    // checking email before creating new account
    public function checkIfEmailAlreadyRegistered($email){
        $sql ="SELECT email FROM users WHERE email=:email";
        $query= $this->dbh-> prepare($sql);
        $query-> bindParam(':email', $email, PDO::PARAM_STR);
        $query-> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        if($query -> rowCount() > 0) {
            return true;
        } else{
           return false;
        }
        
    }

    // logout method
    public function logout(){
        session_destroy();
        $_SESSION = array(); 
        return true;
    }

}

?>