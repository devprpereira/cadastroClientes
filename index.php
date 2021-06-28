<!DOCTYPE html>
<html lang="en">
<?php

session_status() !== 2 ? session_start(): null;

?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require_once("list.php");?>
</body>
</html>