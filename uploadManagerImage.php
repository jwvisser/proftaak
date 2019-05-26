<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];

        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if (!array_key_exists($ext, $allowed))
            die("Error: Kies een geldig formaat.");

        $maxsize = 5 * 1024 * 1024;
        if ($filesize > $maxsize)
            die("Error: Kies een bestand kleiner dan 5MB.");

        if (in_array($filetype, $allowed)) {
            if (file_exists("uploads/" . $filename)) {
                echo $filename . " bestaat al.";
            } else {
                move_uploaded_file($_FILES["photo"]["tmp_name"], "uploads/" . $filename);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }
        } else {
            echo "Error: Er ging iets mis bij het uploaden van de afbeelding, probeer het opnieuw.";
        }
    } else {
        echo "Error: " . $_FILES["photo"]["error"];
    }
}
?>