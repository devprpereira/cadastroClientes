<?php
session_status() !== 2 ? session_start(): null;
require_once("db.php");
$conn = conecta();


?>