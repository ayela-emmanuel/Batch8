<?php
include __DIR__."./lib/connection.php";


$cols = [
    "`id`",
    "`email`",
    "`fullname`"
];

$cols_query = implode(",",$cols );
$query = "SELECT $cols_query from `users` WHERE 1 ";

$stmt = $db->prepare($query);

$executed = $stmt->execute();
if($executed){
    $result = $stmt->get_result();
    $records = [];
    while ($row = $result->fetch_assoc()) {
        $records[] = $row;
        if(count($records)>= 10){
            break;
        }
        
    }
    header("content-type: application/json");
    echo json_encode($records);
}else{
    echo "Failed to Execute";
}

?>