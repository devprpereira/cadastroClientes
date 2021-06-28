<?php

$db = "mysql";
$server = "localhost";
$dbname = "clientes";
$username = "root";
$password = "";
function conecta(){
    global $db, $server, $dbname, $username, $password;
    try {
        return new PDO($db . ":host=" . $server . "; dbname=" . $dbname, $username, $password);
    }
    catch (Exception $e){
        echo ('Ocorreu uma exceção: ' . $e->getMessage());
    }
}
?>
