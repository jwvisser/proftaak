<?php

use smartcaps\db;
use smartcaps\translate;

include("components/header.php");

$language = new smartcaps\translate();
$db = new smartcaps\db();
?>

<style>
    .container-grid{
        display:grid;
        grid-template-columns: auto auto auto;
        grid-column-gap: -5px;
        grid-row-gap:10px;
    }

    .container-grid .product{
        background-image: url('https://via.placeholder.com/300');
        width:300px;
        height:300px;
        text-align:center;

        position:relative;
    }

    .product .title{
        background-color: white;
        width: 100%;
        height: 30px;
        padding: 10px;
        position: absolute;
        top: -20px;
        border:1px solid black;
    }
</style>

<div class="container-grid">
    <?php echo $db->returnProducts(); ?>
</div>

<?php include("components/footer.php"); ?>