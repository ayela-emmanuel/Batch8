<?php
include __DIR__."./lib/const.php";
include_once __DIR__."./lib/connection.php";
include __DIR__."./lib/response_builder.php";
include_once __DIR__."./lib/auth.php";

$body = file_get_contents("php://input");

$data = json_decode($body, true);
//var_dump($data );

$email = $data["email"];
$password = $data["password"];


if(preg_match(EMAIL_REGEX, $email)<1){
    respond(false, 400, "Validation Error: The Email Entered is not Valid");
}

$query = "SELECT * from `users` WHERE `email` = ?";
$stmt = $db->prepare($query);

$executed = $stmt->execute([$email]);
if($executed){
    $result=$stmt->get_result();
    $user = $result->fetch_assoc();
    if($user == null){
        respond(false, 401, "Invalid Credentials");
    }
    // pwd check
    if(password_verify($password,$user["password"])){
        
        $_SESSION["user"] = new User($user["id"],true);
        respond(true, 200, "Loggedin");
    }else{
        respond(false, 401, "Invalid Credentials!");

    }
}
respond(false, 500, "Failed To Login");

?>