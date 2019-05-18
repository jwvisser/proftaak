<?php 
    include("components/header.php"); 

    if(isset($_POST['submit'])){
        $auth = new smartcaps\auth();
        $auth->login($_POST['username'],$_POST['password']);
    }
?>
<form method="POST" action="">
    <input required name="username" type="text" placeholder="Gebruikersnaam">
    <input required name="password"  type="password" placeholder="Wachtwoord">
    <input name="submit" type="submit" value="Login">
</form>
<?php include("components/footer.php"); ?>