<?php

const db_user = "root";
const db_pass = "";
const db_name = "roots_a";
const db_host = "localhost";

$db = null;

try{
    $db = new mysqli(db_host,db_user,db_pass, db_name);

}catch(Exception $e){
    http_response_code(503);
    die("Error connecting to db!");
}


?>