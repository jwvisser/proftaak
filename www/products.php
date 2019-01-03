<?php
include("header.php");

$id = (isset($_GET['drink'])) ? (int) $_GET['drink'] : false;

$sql = "SELECT idIngredient as uniqueId,ingredients.* FROM ingredients ORDER BY drink";
$smt = $conn->prepare($sql);
$smt->execute();
$drinks = $smt->fetchAll(\PDO::FETCH_UNIQUE | \PDO::FETCH_ASSOC);
?>

<form method="GET">
    <select class="select-search" name="drink" required>
        <option value="">Zoek een drankje</option>
        <?php foreach ($drinks as $drink) : ?>
            <option value="<?php echo $drink['idIngredient']; ?>"><?php echo $drink['drink']; ?></option>
        <?php endforeach; ?>
    </select>
    <button class="btn btn-xs btn-primary" type="submit">Selecteer drankje</button>
</form>
<?php
if (!empty($id) && isset($drinks[$id])) {
    $row = $drinks[$id];
    ?>
    <table class="table">
        <thead>
            <tr><th>Product</th><th>Kcal</th><th>Water</th><th>Eiwit</th><th>V-vetten</th><th>OV-vetten</th><th>Cholesterol</th><th>Koolhydraten</th><th>Suiker</th><th>Vitamines</th></tr>
        </thead>
        <tbody>
            <?php
                echo "<tr><td>" . $row["drink"] . "</td><td>" . $row["calories"] . "</td><td>" . $row["amount of water"] . "</td><td>" . $row["protein"] . "</td><td>" . $row["saturated fats"] . "</td><td>" . $row["unsaturated fats"] . "</td><td>" . $row["cholesterol"] . "</td><td>" . $row["carbohydrates"] . "</td><td>" . $row["sugar"] . "</td><td>" . $row["vitamines"] . "</td></tr>";
            ?>
        </tbody>
    </table>
    <?php
} else {
    echo 'Niet gevonden';
}

include("footer.php");
