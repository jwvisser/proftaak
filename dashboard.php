<?php

use smartcaps\db;

include("components/header.php");

$auth = new smartcaps\auth();
$auth->checkAuth();

$products = new smartcaps\db();
$users = new smartcaps\db();
$ingredients = new smartcaps\db();
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

    .content {
        width: 85% !important;
    }
</style>

<div class="container">
    <div class="item">
        <?php $products->returnTable("product", "", ""); ?>
        <form id="product" class="updateForm" method="post">
            <input name="ID" type="hidden" value="<?php echo @$_GET['id'] ?>">
            <?php $products->updateQuery('product', 'name,costprice,sellingprice'); ?>
        </form>
    </div>
    <div class="item">
        <?php $users->returnTable("user", "", ""); ?>
        <form id="user" class="updateForm" method="post">
            <input name="ID" type="hidden" value="<?php echo @$_GET['id'] ?>">
            <?php $products->updateQuery('user', 'username'); ?>
        </form>
    </div>
</div>
<div class="container">
    <div class="item">
        <form action="upload-manager.php" method="post" enctype="multipart/form-data">
            <h2>Upload File</h2>
            <label for="fileSelect">Filename:</label>
            <input type="file" name="photo" id="fileSelect">
            <input type="submit" name="submit" value="Upload">
            <p><strong>Note:</strong> Only .jpg, .jpeg, .gif, .png formats allowed to a max size of 5 MB.</p>
        </form>
    </div>
</div>


<script>
    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
    };

    var table = getUrlParameter('table');

    if ($('#' + table).is(":visible")) {
        $('#' + table).hide();
    } else {
        $('#' + table).show();
    }
</script>

<?php include("components/footer.php"); ?>