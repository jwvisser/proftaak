<?php
include("components/header.php");

$db = new smartcaps\db();
?>

<h1>Voedingswaarden producten</h1>
<h2>Wat zit daar eigenlijk in?</h2>

<p>
<form method="GET">
    <select class="select-search" name="drink" required>
        <option value="">Zoek een drankje</option>
        <?php foreach ($drinks as $drink) : ?>
            <option value="<?php echo $drink['ID']; ?>"><?php echo $drink['name']; ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Selecteer drankje</button>
    <a title="De voedingswaarde zijn per 100 gram.">
        <i class="fas fa-info-circle"></i>
    </a>
</form>
</p>

<?php
if (isset($_GET['drink'])) {
    $db->returnTable("ingredients","name,calories,amount of water, protein, saturated fats, unsaturated fats, cholesterol, carbohydrates, sugar, vitamines","ID = {$_GET['drink']}");
}

include("components/footer.php");
