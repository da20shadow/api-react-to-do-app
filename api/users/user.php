<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: https://sourceofanswers.esy.es');

$url = str_replace('/api/','',$_SERVER['REQUEST_URI']);

if (preg_match("/^\/users\/$/",$url)){

    $users = [
        ["id" => 1, "username" => "Admin", "email" => "admin@email.com"],
        ["id" => 2, "username" => "John", "email" => "john@email.com"],
        ["id" => 3, "username" => "Peter", "email" => "peter@email.com"],
    ];
    echo "<pre>";
    var_dump($users);
    echo "</pre>";
}
else if (preg_match("/^\/users\/user\/\d+$/",$url)){

    $userId = str_replace("/api/users/user/", "",$url);
    echo "GET INFO ABOUT USER ID: " . $userId;

}else if (preg_match("/^\/users\/user$/",$url)) {

    $data = json_decode( file_get_contents('php://input'), true);

    if (isset($data['username']) && isset($data['email'])){
        $created = ["message" =>"Successfully Created!"];
        echo json_encode($created);
    }else {
        $error = ["message"=> "Invalid username or Email!"];
        echo json_encode($error);
    }

}else {
    echo "<h1>404 PAGE NOT FOUND!</h1>";
}