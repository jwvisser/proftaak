<?php include("components/header.php"); ?>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$voornaam = $_POST["voornaam"];
	$achternaam = $_POST["achternaam"];
	$email = $_POST["email"];
	$onderwerp = $_POST["onderwerp"];
	$bericht = $_POST["bericht"];
	
	mail("mail@bitcrazy.nl", $onderwerp, $bericht, "Reply-To: " . $email);
	mail($email, $onderwerp, $bericht, "From: SmartCaps <noreply@bitcrazy.nl>");
	?>
	
	<h1>Bedankt voor je bericht</h1>
	<h2>wij gaan aan de slag</h2>

	<div class="form">
		<p>Bedankt voor je bericht, <?php echo $voornaam; ?>!</p>
		<p>Uw bericht is doorgestuurd naar SmartCaps. Bovendien heeft u de inhoud van uw bericht ook in uw eigen mailbox ontvangen. Wij gaan ermee aan de slag en komen zo snel mogelijk met een reactie. Je kunt dus even achteroverleunen.</p>
		<p>Met vriendelijke groet,</p>
		<img src="images/logoSmartCaps.png" alt="SmartCaps">
	</div>
	
<?php } else { ?>

<h1>Contact opnemen met SmartCaps</h1>
<h2>contactgegevens, locatie en contactformulier</h2>

<div class="form">
	<form method="post" action="contact.php">
		<label>Voornaam</label>
		<input type="text" name="voornaam" placeholder="Uw voornaam" value="<?php echo $voornaam; ?>" />

		<label>Achternaam</label>
		<input type="text" name="achternaam" placeholder="Uw achternaam" value="<?php echo $achternaam; ?>" />

		<label>E-mail adres</label>
		<input type="text" name="email" placeholder="Uw e-mail adres" value="<?php echo $email; ?>" />

		<label>Onderwerp</label>
		<input type="text" name="onderwerp" placeholder="Onderwerp van uw bericht" value="<?php echo $onderwerp; ?>" />

		<label>Bericht</label>
		<textarea name="bericht" placeholder="Schrijf uw bericht hier"><?php echo $bericht; ?></textarea>

		<input type="submit" value="verzend" />
	</form>
</div>

<?php } ?>

<div class="info">
	<strong>SmartCaps</strong><br>
	Hogeschoollaan 1<br>
	4818 CR Breda<br><br>
	Mail: <a href="mailto:mail@bitcrazy.nl">mail@bitcrazy.nl</a><br><br>
	Tel: 088 525 7500<br><br>
	BTW: NL808852218B01<br>
	KVK: 41104408<br><br>
	IBAN: NL31RABO0188917764<br>
	BIC: RABONL2U
</div>

<div id="map">

</div>

<script>
	function initMap() {

		var smartcaps = {lat: 51.5840116, lng: 4.7972549};
		
		var map = new google.maps.Map(
			document.getElementById('map'), {zoom: 8, center: smartcaps});
		
		var marker = new google.maps.Marker({position: smartcaps, map: map});
	}
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAW1JYS_s-x7et0OKs8Z-jYaLSMYivz-Ow&callback=initMap"></script>

<?php include("components/footer.php"); ?>