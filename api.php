<?php 
include('includes/bootstrap.php');


// login api
if(
    isset($_POST['login']) && $_POST['login']!="" &&
    isset($_POST['email']) && $_POST['email']!="" &&
    isset($_POST['password']) && $_POST['password']!=""
){
    $email = $_POST['email'];
    $password = $_POST['password'];
    if($userAuthClass->login($email, $password)){
        echo json_encode([
            'status' => 'success',
            'message' => "Successfully logged in"            
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => $userAuthClass->errorMsg            
        ]);
        http_response_code(401);
    } 
    return;
}

// signup api
// create new user account, store laptop and lease information
if(
    isset($_POST['signup']) && $_POST['signup']!="" &&
    isset($_POST['name']) && $_POST['name']!="" &&
    isset($_POST['gender']) && $_POST['gender']!="" &&
    isset($_POST['email']) && $_POST['email']!="" &&
    isset($_POST['password']) && $_POST['password']!="" &&
    isset($_POST['confirmPassword']) && $_POST['confirmPassword']!="" 
){
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if($userAuthClass->signup(
        $name,
        $gender,
        $email,
        $password,
        $confirmPassword
    )){
        echo json_encode([
            'status' => 'success',
            'message' => "Successfully created account"            
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => $userAuthClass->errorMsg            
        ]);
    } 
    return;
}

// check if email is already registered
if(
    isset($_POST['checkEmail']) && $_POST['checkEmail']!="" &&
    isset($_POST['email']) && $_POST['email']!=""
){
    $email = $_POST['email'];
    if($userAuthClass->checkIfEmailAlreadyRegistered($email)){
        echo 'Email already registred. ';
    } else {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)===false) {
            echo "Invalid email. ";
        } else {
            echo 0;
        }
    } 
    return;
}

// logout api, destory user sessions
if(
    isset($_POST['logout']) && $_POST['logout']!=""
){
    if($userAuthClass->logout()){
        echo true;
    } else {
        http_response_code(401);
    } 
    return;
}



/*=============================================================
===============================================================
===============================================================
===============================================================
===============================================================

 Fav Countires

===============================================================
===============================================================
===============================================================
===============================================================
===============================================================*/


if(
    isset($_POST['addRemoveFav']) && $_POST['addRemoveFav']!="" &&
    isset($_POST['reqType']) && $_POST['reqType']!="" &&
    isset($_POST['countryName']) && $_POST['countryName']!="" &&
    isset($_POST['countryRegion']) && $_POST['countryRegion']!="" &&
    isset($_POST['countryPopulation']) && $_POST['countryPopulation']!="" &&
    isset($_SESSION['loggedIn'])
){
    $reqType = $_POST['reqType'];
    $countryName = $_POST['countryName'];
    $countryRegion = $_POST['countryRegion'];
    $countryPopulation = $_POST['countryPopulation'];
    $description = $_POST['description'];

    if($countryClass->addRemoveFav(
        $reqType,
        $countryName,
        $countryRegion,
        $countryPopulation,
        $description
    )){
        echo json_encode([
            'status' => 'success',
            'message' => $countryClass->successMsg            
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => $countryClass->errorMsg            
        ]);
    } 
    return;
}


if(
    isset($_GET['getFavList']) && $_GET['getFavList']!="" &&
    isset($_SESSION['loggedIn'])
){

    echo json_encode([
        'status' => 'success',
        'message' => "",
        "data" => $countryClass->getFavList()         
    ]);
    return;
}


?>