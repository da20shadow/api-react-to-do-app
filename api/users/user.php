<?php
echo "USERS DATA <br>";
echo "<br>";
echo "URL:";

$url = $_SERVER['REQUEST_URI'];

var_dump($url);
echo "<br>";
echo "<hr>";
echo "<br>";

if (preg_match("/\//",$url)){

    $users = [
        ["id" => 1, "username" => "Admin", "email" => "admin@email.com"],
        ["id" => 2, "username" => "John", "email" => "john@email.com"],
        ["id" => 3, "username" => "Peter", "email" => "peter@email.com"],
    ];
    echo "<pre>";
    var_dump($users);
    echo "</pre>";
}
else if (preg_match("/\/user/",$url)){
    echo "GET ONE USER";
}