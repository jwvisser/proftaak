<?php
include("components/header.php");

use smartcaps\translate;

$language = new smartcaps\translate();

$db = new smartcaps\db();

$drinks = $db->runQuery("SELECT * FROM ingredients");

print($language->getHTML("products", "title"));
?>

<p>
<form method="GET">
    <select class="select-search" name="drink" required>
        <?php $language->getHTML("products", "searchBar") ?>
        <?php foreach ($drinks as $drink) : ?>
            <option value="<?php echo $drink['ID']; ?>"><?php echo $drink['name']; ?></option>
        <?php endforeach; ?>
    </select>
    <?php $language->getHTML("products", "selectDrink") ?>
    <i class="fas fa-info-circle"></i>
</a>
</form>
</p>

<?php
if (isset($_GET['drink'])) {
    $db->returnTable("ingredients", "", "ID = {$_GET['drink']}");
}

include("components/footer.php");
