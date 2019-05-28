<?php

use smartcaps\db;

use smartcaps\upload;

include("components/header.php");

$auth = new smartcaps\auth();
$auth->checkAuth();

$products = new smartcaps\db();
$users = new smartcaps\db();
$ingredients = new smartcaps\db();

$upload = new smartcaps\upload();

if(isset($_POST['submitImage'])){
    $upload->uploadImage();
}else if(isset($_POST['submitCSV'])){
    $upload->uploadCSV();
}



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
    </div>
    <div class="item">
        <?php $users->returnTable("user", "", ""); ?>
    </div>
</div>
<div class="container">
    <div class="item">
        <form method="post" enctype="multipart/form-data">
            <h3>Upload afbeeldingen</h3>
            <label for="fileSelect">Bestandsnaam:</label>
            <input type="file" name="photo" id="fileSelect">
            <input type="submit" name="submitImage" value="Upload">
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
        <form method="post" enctype="multipart/form-data">
            <h3>Upload CSV-bestand</h3>
            <label for="fileSelect">Bestandsnaam:</label>
            <input type="file" name="fileToUpload" accept=".csv">
            <input type="submit" value="Upload" name="submitCSV">
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
        if (($h = fopen("uploads/export_950_facturen_14(1).csv", "r")) !== FALSE) {
            // Convert each line into the local $data variable
            while (($data = fgetcsv($h, 1000, ",")) !== FALSE) {
                $newPrice = $data[0];
            }

            // Close the file
            fclose($h);
        }
        ?>
    </div>
</div>

<?php include("components/footer.php"); ?>