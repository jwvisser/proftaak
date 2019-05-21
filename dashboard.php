<?php

use smartcaps\db;

include("components/header.php");

    $auth = new smartcaps\auth();
    $auth->checkAuth();

    $products = new smartcaps\db();
    $users = new smartcaps\db();
?>

<style>
    .container{
        display:grid;
        width:100%;
        grid-template-columns: auto auto;
    }
    .item{
        padding:10px;
    }
</style>

<div class="container">
    <div class="item">
        <?php $products->returnTable("product","",""); ?>
    </div>
    <div class="item">
        <?php $users->returnTable("user","",""); ?>
    </div>
</div>

<?php include("components/footer.php"); ?>