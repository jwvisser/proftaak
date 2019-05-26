<?php

$target_dir = "uploads/";
$filename = $_FILES["fileToUpload"]["name"];
$target_file = $target_dir . $filename;
$fileType = pathinfo($target_file, PATHINFO_EXTENSION);

// Allow certain file formats
if ($fileType != "csv") {
    echo "Sorry, only CSV files are allowed. ";
} else {
    if (file_exists("uploads/" . $filename)) {
        echo $filename . " bestaat al.";
    } else {
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "uploads/" . $filename);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
