<?php 
    include("components/header.php"); 

    $auth = new smartcaps\auth();
    $auth->checkAuth();
?>

<?php include("components/footer.php"); ?>