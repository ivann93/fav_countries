<?php
require_once('DbClass.php');

// country class
// provide add to fav, remove from fav

class CountryClass extends DbClass {

    public $errorMsg = '';
    public $successMsg = '';

    public function __construct() {
        // get connected to database by parent constructor
        parent::__construct();
    }

    // add/remove from fav
    public function addRemoveFav(
        $reqType,
        $countryName,
        $countryRegion,
        $countryPopulation,
        $description
    ){
        
        $userId = $_SESSION['userId'];
        if($reqType=="add") {
            try {

                $sql ="SELECT * FROM favourites WHERE country_name=:countryName AND user_id=:userId";
                $query1= $this->dbh-> prepare($sql);
                $query1-> bindParam(':countryName', $countryName, PDO::PARAM_STR);
                $query1-> bindParam(':userId', $userId, PDO::PARAM_STR);
                $query1-> execute();
                $results = $query1-> fetchAll(PDO::FETCH_OBJ);

                if(!$results) {
                    $dateTime = date('Y-m-d H:i:s');
                    $sql ="INSERT INTO favourites (country_name, country_region, country_population, user_id, created_at, description) VALUES (:countryName, :countryRegion, :countryPopulation, :userId, :dateTime, :description)";
                    $query= $this->dbh->prepare($sql);
                    $query-> bindParam(':countryName', $countryName, PDO::PARAM_STR);
                    $query-> bindParam(':countryRegion', $countryRegion, PDO::PARAM_STR);
                    $query-> bindParam(':countryPopulation', $countryPopulation, PDO::PARAM_STR);
                    $query-> bindParam(':userId', $userId, PDO::PARAM_STR);
                    $query-> bindParam(':dateTime', $dateTime, PDO::PARAM_STR);
                    $query-> bindParam(':description', $description, PDO::PARAM_STR);
            
                    $query-> execute();
                }
                $this->successMsg = "Successfully added";
                return true;

            } catch(PDOException $e) {
                $this->errorMsg = $e->getMessage();
                return false;
            }
    
    
        } else if($reqType=="remove") {
            try {
            $sql ="DELETE FROM favourites WHERE country_name=:countryName AND user_id=:userId";
                $query= $this->dbh->prepare($sql);
                $query-> bindParam(':countryName', $countryName, PDO::PARAM_STR);
                $query-> bindParam(':userId', $userId, PDO::PARAM_STR);
        
                $query-> execute();
                $this->successMsg = "Successfully removed";
                return true;
            } catch(PDOException $e) {
                $this->errorMsg = $e->getMessage();
                return false;
            }

        }

    }


    public function getFavList(){
        $userId = $_SESSION['userId'];
        $sql ="SELECT * FROM favourites WHERE user_id=:userId";
        $query= $this->dbh-> prepare($sql);
        $query-> bindParam(':userId', $userId, PDO::PARAM_STR);
        $query-> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        return $results;
    }


}

?>