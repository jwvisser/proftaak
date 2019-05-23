<?php

use smartcaps\auth;
use smartcaps\db;

include("components/header.php");

$auth = new smartcaps\auth();
$auth->checkAuth();

$db = new smartcaps\db();

$id = $_GET['id'];
$table =  $_GET['table'];
$db->deleteQuery($table,$id);

?>