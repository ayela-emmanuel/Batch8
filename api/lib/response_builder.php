<?php

function respond(bool $result,int $code = 200,?string $message = null, $data = null){
    http_response_code($code );
    header("content-type: application/json");
    echo(json_encode(
        [
            "result"=>$result,
            "message"=>$message,
            "data"=>$data
        ]
        ));

    exit();
}

?>