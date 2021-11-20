<?php

//getting the file from a post request
$file = file_get_contents($_FILES['fileToUpload']['tmp_name']);
$fileName = $_FILES['fileToUpload']['name'];
$ext = pathinfo($fileName, PATHINFO_EXTENSION);

//setting up which class to call, depending on file type
$loader_type = $ext."_loader";

include "get_file_data.php";

try {
    $loader = new $loader_type(file_get_contents($_FILES['fileToUpload']['tmp_name']));
    $loader->load();
    $loader->show();
    
} catch (Exception $e) {
    echo "Error: ".$e;
}

?>