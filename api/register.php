<?php
include __DIR__."./lib/const.php";
include __DIR__."./lib/connection.php";
include __DIR__."./lib/response_builder.php";




$body = file_get_contents("php://input");

$data = json_decode($body, true);
//var_dump($data );

// Unpack
// Hash Password
// Add User To DB
$name = $data["name"];
$email = $data["email"];
$password = $data["password"];

if(preg_match(EMAIL_REGEX, $email)<1){
    respond(false, 400, "Validation Error: The Email Entered is not Valid");
}
// Validate pwd and email RegEx
$password = password_hash($password, PASSWORD_DEFAULT);

$cols = [
    "`fullname`" => $name,
    "`email`" => $email,
    "`password`" => $password
];

$cols_query = implode(",", array_keys($cols) );
$query = "INSERT INTO `users` ( $cols_query )  VALUES (?,?,?)";

$stmt = $db->prepare($query);

$executed = $stmt->execute(array_values($cols));
if($executed){
    respond(true, 200, "Created");
 
}
respond(false, 500, "Failed To Create");

