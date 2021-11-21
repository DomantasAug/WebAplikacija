<?php

include "index.html";
include "get_file_data.php";

//getting the file from a post request
$file = file_get_contents($_FILES['fileToUpload']['tmp_name']);
$fileName = $_FILES['fileToUpload']['name'];
$ext = pathinfo($fileName, PATHINFO_EXTENSION);

//setting up which class to call, depending on file type
$loader_type = $ext."_loader";

try {
    //check if loader class exists for loaded file type
    if (class_exists($loader_type))
    {
        $loader = new $loader_type($file);
        $loader->load();
        $loader->show();
    }
    else
    {
        echo "Unsupported file loaded";
    }
      
} catch (Exception $e) {
    echo "Error: ".$e;
}

?>