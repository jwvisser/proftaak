<?php

use smartcaps\translate;

include("components/header.php");

$language = new smartcaps\translate();
?>
<div class="row">
<?php $language->getHTML("index", "smartcap") ?>
</div>
<br /><br />
<div class="row">		
    <div class="column">
<?php $language->getHTML("index", "quality") ?>
    </div>
    <div class="column">
<?php $language->getHTML("index", "milieu") ?>
    </div>
    <div class="column">       
<?php $language->getHTML("index", "applicatie") ?>
    </div>
</div>
<?php include("components/footer.php"); ?>