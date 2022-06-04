<?php

use App\Repositories\user\UserRepository;
use App\Services\encryption\ArgonEncryptionService;
use App\Services\user\UserService;
use Database\PDODatabase;

spl_autoload_register();

$base = $_SERVER['DOCUMENT_ROOT'];
$file = $base . DIRECTORY_SEPARATOR . "Config/db.ini";
$dbInfo = parse_ini_file($file);

$pdo = null;

try {
    $pdo = new PDO($dbInfo['dsn'],$dbInfo['user'],$dbInfo['pass']);
    echo "Successfully Connected! \n";
}catch (\mysql_xdevapi\Exception $exception){
    echo $exception->getMessage();
}

$db = new PDODatabase($pdo);
$encryptionService = new ArgonEncryptionService();
$userRepository = new UserRepository($db);
$userService = new UserService($userRepository,$encryptionService);