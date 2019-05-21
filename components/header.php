<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('./vendor/autoload.php');

$languageswitch = new smartcaps\translate();

session_start();

?>
<!DOCTYPE html>
<html lang="nl">
    <head>
        <title>SmartCaps</title>
        <meta charset="UTF-8">
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Lato|Lora|Source+Sans+Pro" rel="stylesheet"> 
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    </head>
    <body>
        <div class="footerpusher">
            <div class="topnavbackground">
                <div class="topnavbar">
                    <span><a href="./">SMARTCAPS</a></span>
                    <a href="./">Home</a>
                    <a href="./products">Voedingswaarden</a>
                    <a href="./about-us">Over Ons</a>
                    <a href="./contact">Contact</a>
                </div>
                <div class="secondTopNav">
                    <?php 
                    if(@$_SESSION['login_Status'] == true)  echo '<a href="./logout">logout</a>' . ' | ' . '<a href="./dashboard">Dashboard</a>';
                    else echo '<a href="./login">Login</a>'; ?>
                    | <a href="?language=nl">NL</a> / <a href="?language=en">EN</a>
                </div>
            </div>
            <div class="headerbackground">
                <div class="headerbar">
                    <h1>SMARTCAPS</h1>
                    <h2>keep track.</h2>
                </div>
            </div>
            <div class="content">
