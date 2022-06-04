<?php

header("Content-Type: application/json");
header('Access-Control-Allow-Origin: https://sourceofanswers.esy.es');


//$url = str_replace('/','',$_SERVER['REQUEST_URI']);
$url =$_SERVER['REQUEST_URI'];


echo "The URL is: " . $url;
echo "\n";
echo "\n";
// when url /users or /users/ return all users
if (preg_match("/^\/users$/",$url) || preg_match("/^\/users\/$/",$url)){


    $users = [
        ["id" => 1, "username" => "Admin", "email" => "admin@email.com"],
        ["id" => 2, "username" => "John", "email" => "john@email.com"],
        ["id" => 3, "username" => "Peter", "email" => "peter@email.com"],
    ];

    echo json_encode($users,JSON_PRETTY_PRINT);

}
// when url /users/123 return the user id or update the user with id
else if (preg_match("/^\/user\/\d+$/",$url)){

    $userId = str_replace("/user/", "",$url);

    $data = json_decode( file_get_contents('php://input'), true);


    if (isset($_GET)){

        echo json_encode(["message" => "Requested info about user id: " . $userId]);

    }else if (isset($data['user_id'])){

        echo json_encode(["message" => "Requested to UPDATE INFO ABOUT USER ID: " . $data['user_id']]);

    }else {

        echo "ERROR!";

    }

}
// when url /user create new user
else if (preg_match("/^\/user$/",$url)) {

    $data = json_decode( file_get_contents('php://input'), true);

    if (isset($data['username']) && isset($data['email'])){

        $created = ["message" =>"Successfully Created!"];
        echo json_encode($created);

    }else {

        $error = ["message"=> "Invalid username or Email!"];
        echo json_encode($error);

    }

}else {

    $error = ["message" => "404 PAGE NOT FOUND!"];
    echo json_encode($error);

}