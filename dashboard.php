<?php

use smartcaps\db;
use smartcaps\upload;

include("components/header.php");

$auth = new smartcaps\auth();
$auth->checkAuth();

$products = new smartcaps\db();
$users = new smartcaps\db();
$ingredients = new smartcaps\db();
$searchFound = new smartcaps\db();
$searchNotFound = new smartcaps\db();

$upload = new smartcaps\upload();

if (isset($_POST['submitImage'])) {
    $upload->uploadImage();
} else if (isset($_POST['submitCSV'])) {
    $upload->uploadCSV();
}

if (isset($_POST['updatePrice'])) {
    $products->updatePrice($_POST['productName'], $_POST['productPrice']);
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

    input[type=text], input[type=password], textarea {
        font-family: 'Lato', sans-serif;
        background-color: #FFF2F7;
        width: 40%;
        display: flex;
        padding: 14px;
        border: 2px solid #611D6A;
        border-radius: 6px;
        margin-bottom: 30px;
        margin-top: 5px;
        resize: vertical;
        box-sizing: border-box;
    }
</style>

<div class="container">
    <div class="item">
		<h1>Shop items </h1>
        <?php $products->returnTable("product", "", ""); ?>
    </div>
    <div class="item">
		<h1>Admin accounts</h1>
        <?php $users->returnTable("user", "", ""); ?>
    </div>
</div>
<nav>
	<a href = "product-new.php" title = "add a record">New record</a>
</nav>
<br /><br />
<div class="container">
    <div class="item">
        <form method="post" enctype="multipart/form-data">
            <h1>Upload afbeeldingen</h1>
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
            <h1>Upload CSV-bestand</h1>
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


            if (($file = fopen("$csv", "r")) !== FALSE) {
                // Convert each line into the local $data variable
                while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
                    $newPrice = $data;
                }
                // Close the file
                fclose($file);
            }
            $productName = $newPrice[0];
            $productPrice = $newPrice[1];

            $ext = strtolower(pathinfo($csv, PATHINFO_EXTENSION));
            if (in_array($ext, $supported_file)) {
                
                ?>
        <form method="post">
            <label>Update prijs:</label>
            <input type="hidden" value="<?php echo $productName; ?>" name="productName">
            <input type="hidden" value="<?php echo $productPrice; ?>" name="productPrice">
            <?php echo '<a href="' . $csv . '">' . substr($csv, 8) . '</a>'; ?>
            <input type="submit" value="Update" name="updatePrice"><br><br>
        </form>
        <?php
        
            } else {
                continue;
            }
        }
        ?>
    </div>
</div>
<br /><br /><br />
<div class="container">
	<div class="item">
		<h1>Gevonden zoektermen</h1>
		<?php $searchFound->returnTable("search", "", "found = '1'"); ?>
	</div>
	<div class="item">
		<h1>Niet gevonden zoektermen</h1>
		<?php $searchNotFound->returnTable("search", "", "found = '0'"); ?>
	</div>
</div>

<script>
    function hideForm(table){
        $('#'+table).hide();
        window.location.replace(window.location.pathname)
    }
</script>

<?php include("components/footer.php"); ?>