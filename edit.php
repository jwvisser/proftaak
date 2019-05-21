<?php

use smartcaps\auth;
use smartcaps\db;

include("components/header.php");

$auth = new smartcaps\auth();
$auth->checkAuth();

?>