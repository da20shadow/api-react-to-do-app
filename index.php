<?php
require_once('common.php');

header("Content-Type: application/json");
header('Access-Control-Allow-Origin: https://sourceofanswers.esy.es');


$url = str_replace('backend-react-to-do-app/index.php?','',$_SERVER['REQUEST_URI']);


//$url = $_SERVER['REQUEST_URI']; //original
$data = json_decode(file_get_contents('php://input'), true);

//echo "The URL is: " . $url;
//echo "\n";
//echo "\n";
// when url /users or /users/ return all users
if (preg_match("/^\/users$/", $url) || preg_match("/^\/users\/$/", $url)) {

    if (isset($data['accessToken']) && isset($data['user_id'])) {

        //TODO: to verify that this user have rights to get all users info

        $users = [
            ["id" => 1, "username" => "Admin", "email" => "admin@email.com"],
            ["id" => 2, "username" => "John", "email" => "john@email.com"],
            ["id" => 3, "username" => "Peter", "email" => "peter@email.com"],
        ];
        $users = $userService->getAll();

        echo json_encode($users, JSON_PRETTY_PRINT);
    } else {
        $error = ["message" => "You have no rights to get this data!"];
        echo json_encode($error, JSON_PRETTY_PRINT);
    }


} // when url /users/123 return the user id or update the user with id
else if (preg_match("/^\/user\/\d+$/", $url)) {

    $userId = str_replace("/user/", "", $url);


    if (isset($_GET)) {

        echo json_encode(["message" => "Requested info about user id: " . $userId]);

    } else if (isset($data['user_id'])) {

        echo json_encode(["message" => "Requested to UPDATE INFO ABOUT USER ID: " . $data['user_id']]);

    } else {

        echo "ERROR!";

    }

} // when url /user create new user
else if (preg_match("/^\/user$/", $url)) {

    if (isset($data['username']) && isset($data['email'])
        && isset($data['password']) && isset($data['confirm_password'])) {

        $userDTO = new \App\Models\user\UserDTO();
        try {
            $userDTO->setUsername($data['username']);
            $userDTO->setEmail($data['email']);
            $userDTO->setPassword($data['password']);

            $result = $userService->register($userDTO, $data['confirm_password']);

            if (str_contains($result,'Error')){

                header('HTTP:1.1',true,403);
                $message = ["message" => $result];
                echo json_encode($message);

            }else if (str_contains($result,'Successfully')){

                $message = ["message" => $result];
                echo json_encode($message);

            }else {

                header('HTTP:1.1',true,403);
                $message = ["message" => $result];
                echo json_encode($message);

            }

        } catch (Exception $exception) {

            $message = $exception->getMessage();
            $error = ["message" => $message];
            echo json_encode($error);

        }


    } else {

        $error = ["message" => "Invalid username or Email!"];
        echo json_encode($error);

    }

} else {

    $error = ["message" => "404 PAGE NOT FOUND!"];
    echo json_encode($error);

}