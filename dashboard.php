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
        <form action="uploadManagerImage.php" method="post" enctype="multipart/form-data">
            <h3>Upload afbeeldingen</h3>
            <label for="fileSelect">Bestandsnaam:</label>
            <input type="file" name="photo" id="fileSelect">
            <input type="submit" name="submit" value="Upload">
            <p><strong>NB:</strong> Alleen .jpg, .jpeg, .gif, .png zijn toegestane formaten met een grote van maximaal 5MB.</p>
        </form>
        <?php
        $files = glob("uploads/*.*");
        for ($i = 0; $i < count($files); $i++) {
            $image = $files[$i];
            $supported_file = array(
                'gif',
                'jpg',
                'jpeg',
                'png'
            );

            $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
            if (in_array($ext, $supported_file)) {
                echo '<a href="' . $image . '">' . substr($image, 8) . '</a><br>';
            } else {
                continue;
            }
        }
        ?>
    </div>
    <div class="item">
        <form action="uploadManagerCsv.php" method="post" enctype="multipart/form-data">
            <h3>Upload CSV-bestand</h3>
            <label for="fileSelect">Bestandsnaam:</label>
            <input type="file" name="fileToUpload" accept=".csv">
            <input type="submit" value="Upload" name="submit">
        </form>
        <?php
        $csvFiles = glob("uploads/*.csv");
        for ($i = 0; $i < count($csvFiles); $i++) {
            $csv = $csvFiles[$i];
            $supported_file = array(
                'csv'
            );

            $ext = strtolower(pathinfo($csv, PATHINFO_EXTENSION));
            if (in_array($ext, $supported_file)) {
                echo '<a href="' . $csv . '">' . substr($csv, 8) . '</a><br>';
            } else {
                continue;
            }
        }
        // Open the file for reading
        if (($h = fopen("uploads/export_950_facturen_14.csv", "r")) !== FALSE) {
            // Convert each line into the local $data variable
            while (($data = fgetcsv($h, 1000, ",")) !== FALSE) {
                $newPrice = $data[0];
                echo $newPrice;
            }

            // Close the file
            fclose($h);
        }
        ?>
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