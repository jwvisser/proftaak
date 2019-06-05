<?php

include("components/header.php");
$db = new smartcaps\db();

	if (isset($_POST['Search'])) {

		if (preg_match("/^[  a-zA-Z]+/", $_POST['search'])) {
			$search = $_POST['search'];

			echo "<h1>{$search}</h1>";
			echo "<h2>de zoekresultaten</h2>";
			
			$sql = "SELECT DISTINCT page FROM content WHERE html LIKE '%{$search}%'";
			$results = $db->runQuery($sql);
			$count = $db->getRowCount($sql);

			if ($count == 0) {
				$db->updateSearch($search, 0);
				echo "We hebben helaas niets kunnen vinden.";
			}
			
			else {
				$db->updateSearch($search, 1);

				echo "We hebben uw zoekterm op de volgende pagina's kunnen vinden:<br />";

				foreach ($results as $result) {
					$page = $result['page'];

					if ($result['page'] == "index") {
						$page = "home";
					}

					echo "<br /><a href='{$result['page']}'>{$page}</a>";
				}
			}
		}

		else {
			echo "<h1>oeps, foutje!</h1>";
			echo "<h2>er is iets misgegaan</h2>";
			echo  "<p>Zoekveld niet ingevuld.</p>";
		}
	}

include("components/footer.php");

?>