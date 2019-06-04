<?php
include("components/header.php");

use smartcaps\translate;

$language = new smartcaps\translate();

print($language->getHTML("about-us", "title"));
?>

<style>
    .row:first-of-type{
        display:flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: center;
    }
</style>

<div class="row">
    <div class="aboutColumn">
        <?php $language->getHTML("about-us", "rene") ?>
    </div>
    <div class="aboutColumn">
        <?php $language->getHTML("about-us", "stefan") ?> 
    </div>
    <div class="aboutColumn">
        <?php $language->getHTML("about-us", "jw") ?>
    </div>
    <div class="aboutColumn">
        <?php $language->getHTML("about-us", "robbert") ?>
    </div>
</div>
<hr>
<div class="row">
    <?php $language->getHTML("about-us", "title2") ?>
    <?php $language->getHTML("about-us", "vision") ?> 
</div>
<?php include("components/footer.php"); ?>