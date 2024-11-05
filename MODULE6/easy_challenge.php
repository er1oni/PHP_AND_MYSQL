<!-- Write a PHP script that reads the content of a text file and displays it on the web page. 
Use built-in file functions such as file_get_contents or fopen and fread0) 
to read the file contents, and then output it to the browser using PHP echo or print. -->

<?php

//Using file_get_contents()

$file_path = 'example.txt';


if (file_exists($file_path)) {

    $content = file_get_contents($file_path);

    echo "$content";
} else {
    echo "File not found.";
}

//Using fopen() and fread()

$file_path = 'example.txt';


if (file_exists($file_path)) {

    $file = fopen($file_path, 'r');
    

    if ($file) {

        $content = fread($file, filesize($file_path));
        
        fclose($file);

        echo "$content";
    } else {
        echo "Error opening the file.";
    }
} else {
    echo "File not found.";
}


?>
