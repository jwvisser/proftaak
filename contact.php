<?php include("header.php"); ?>

<h1>Contactformulier</h1>

<div class="form">
	<form>
		<label>Voornaam</label>
		<input type="text" placeholder="Uw voornaam" />

		<label>Achternaam</label>
		<input type="text" placeholder="Uw achternaam" />

		<label>E-mail adres</label>
		<input type="text" placeholder="Uw e-mail adres" />

		<label>Onderwerp</label>
		<input type="text" placeholder="Onderwerp van uw bericht" />

		<label>Bericht</label>
		<textarea placeholder="Schrijf uw bericht hier"></textarea>

		<input type="submit" value="Verzend" />
	</form>
</div>

<?php include("footer.php"); ?>