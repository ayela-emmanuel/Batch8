<?php
include __DIR__."./lib/connection.php";

$body = file_get_contents("php://input");

$data = json_decode($body, true);
var_dump($data );

// Unpack
// Hash Password
// Add User To DB
$name = $data["name"];
$email = $data["email"];
$password = $data["password"];
// Validate
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
    http_response_code(200);
    exit();
}
http_response_code(400);
