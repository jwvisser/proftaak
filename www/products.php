<?php

include("header.php");

$sql = "SELECT idIngredients as unique,ingredients.* FROM ingredients ORDER BY drink";
$smt = $conn->prepare($sql); 
$drinks = $smt->fetchAll(\PDO::FETCH_UNIQUE|\PDO::FETCH_ASSOC);

?>

<form method="GET">
    <select name="drink" required>
    <option value=""></option>
    <?php foreach ($drinks as $drink) : ?>
    <option value="<?php echo $drink['idIngredients']; ?>"><?php echo $drink['drink']; ?></option>
    <?php endforeach; ?>
</select>
</form>
<?php
/*
    echo "<table><tr><th>Product</th><th>Kcal</th><th>Water</th><th>Eiwit</th><th>V-vetten</th><th>OV-vetten</th><th>Cholesterol</th><th>Koolhydraten</th><th>Suiker</th><th>Vitamines</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["drink"] . "</td><td>" . $row["calories"] . "</td><td>" . $row["amount of water"] . "</td><td>" . $row["protein"] . "</td><td>" . $row["saturated fats"] . "</td><td>" . $row["unsaturated fats"] . "</td><td>" . $row["cholesterol"] . "</td><td>" . $row["carbohydrates"] . "</td><td>" . $row["sugar"] . "</td><td>" . $row["vitamines"] . "</td></tr>";
    }

    echo "</table>";
} else {
    echo "<p>Geen resultaten gevonden.</p>";
}

include("footer.php");