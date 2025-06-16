<?php 
include_once __DIR__."/../lib/auth.php";
User::RequireAuth();
respond(true,message:"Fetched",data:User::GetCurrentUser());
