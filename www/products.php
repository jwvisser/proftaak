<?php

    include("header.php");

	echo "<h1>voedingswaarden producten</h1><h2>wat zit daar eigenlijk in?</h2>";

    include('../private/_config.php');

    $conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		echo "<p>Verbinden mislukt: " . $conn->connect_error . "</p>";
	}

	$sql = "SELECT *
			FROM ingredients
			ORDER BY drink";

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		echo "<table><tr><th>Product</th><th>Kcal</th><th>Water</th><th>Eiwit</th><th>V-vetten</th><th>OV-vetten</th><th>Cholesterol</th><th>Koolhydraten</th><th>Suiker</th><th>Vitamines</th></tr>";
    
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>".$row["drink"]."</td><td>".$row["calories"]."</td><td>".$row["amount of water"]."</td><td>".$row["protein"]."</td><td>".$row["saturated fats"]."</td><td>".$row["unsaturated fats"]."</td><td>".$row["cholesterol"]."</td><td>".$row["carbohydrates"]."</td><td>".$row["sugar"]."</td><td>".$row["vitamines"]."</td></tr>";
		}
    
		echo "</table>";
	} else {
		echo "<p>Geen resultaten gevonden.</p>";
	}
	
	include("footer.php");

?>