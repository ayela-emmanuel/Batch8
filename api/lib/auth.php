<?php
include_once __DIR__."/connection.php";
include_once __DIR__."/response_builder.php";
session_start();

class User{
    public int $id;
    public string $fullname;
    public string $email;
    public ?DateTime $loggedin;
    
    public function __construct(?int $id, ?bool $loggingIn = false) {
        if($id!=null){
            $data = User::GetUserById($id);
            $this->id = $data["id"];
            $this->fullname = $data["fullname"];
            $this->email = $data["email"];
            if($loggingIn){
                $this->loggedin = new DateTime();
            }
        }
    }

    private static function GetUserById(int $id){
        $db = $GLOBALS['db'];
        $query = "SELECT * from `users` WHERE `id` = ?";
        $stmt = $db->prepare($query);

        $executed = $stmt->execute([$id]);
        if($executed){
            $result=$stmt->get_result();
            $user = $result->fetch_assoc();
            return $user;
        }
        return null;
    }


    public static function GetCurrentUser():User{
        return $_SESSION["user"]; 
    }


    public static function isLoggedIn():bool{
        return isset($_SESSION["user"]); 
    }

    /**
     * Checks if user has access/is logged in
     * In User is not logged in respond with 401
     * @return void
     */
    public static function RequireAuth(){
        if(User::isLoggedIn()){
            return;
        }
        respond(false, 401);
    }
}





