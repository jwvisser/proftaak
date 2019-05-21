<?php
use smartcaps\translate;

include("components/header.php");

$language = new smartcaps\translate();
?>
<div class="row">		
    <div class="column">
        <?php $language->getHTML("index","quality") ?>
    </div>
    <div class="column">
        <?php $language->getHTML("index","milieu") ?>
    </div>
    <div class="column">
        <div class="centerImage">
            <i class="fas fa-mobile-alt mobiel"></i>
        </div>
        <div class="center">
            <h1>Applicatie</h1>
        </div>
        <p> Via de applicatie op je mobiele telefoon kun je de opgeslagen gegevens van je SmartCap bijhouden. Deze gegevens kun je delen via social media, of vergelijken met je vrienden binnen de applicatie. De SmartCap applicatie is 100% gratis te downloaden in zowel de Appstore als de Google Playstore.
        </p>
    </div>
</div>
<hr>
<div class="row">		
    <div class="centerImage">
        <img src="assets/logoSmartCaps.png" alt="SmartCaps"> 
    </div>
    <div class="center">
        <h1>De SmartCap</h1>
    </div>
    <p>De SmartCap is de tool die jij nodig hebt, het is een universele dop en dat betekent dat deze op vrijwel alle flesjes past. De SmartCap zorgt ervoor dat je bij kunt houden hoeveel je drinkt, wat je drinkt maar ook wanneer je drinkt. Al deze gegevens worden doorgestuurd naar de SmartCaps database en vervolgens automatisch verwerkt. Hierdoor kan jij als gebruiker je statistieken van de SmartCap terug zien in de applicatie of op de website. Daarnaast kun je je opgeslagen gegevens vergelijken of delen met familie, vrienden, collega's of bijvoorbeeld leden van je sportvereniging. </p>
    <p>De SmartCap is makkelijk te gebruiken, je draait hem op je flesje en klaar! Je kunt kiezen uit verschillende kleuren voor de Smartcap.
De batterijduur is maar net afhankelijk van het gebruik. De SmartCap gaat minimaal 24 uur mee, waardoor je hem gemakkelijk 's nachts op kunt laden zodat je hem de volgende dag weer kunt gebruiken. De batterij is makkelijk op te laden met je telefoonoplader door de universele USB-poort.</p>
</div>
<?php include("components/footer.php"); ?>