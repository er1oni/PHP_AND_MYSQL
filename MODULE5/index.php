<?php
 
/*$dogs = array(
    array("Chihuahua", "mexico", "20"),
    array("Husky", "Siberia", "15"),
    array("Bulldog", "England", "10")
);

echo $dogs[0][0], "Origin: " . $dogs[0][1] . ", Life Span:" .$dogs[0][2]. ",<br>";
echo $dogs[0][0], "Origin: " . $dogs[0][1] . ", Life Span:" .$dogs[0][2]. ",<br>";
echo $dogs[0][0], "Origin: " . $dogs[0][1] . ", Life Span:" .$dogs[0][2]. ",<br>";


for ($row = 0; $row<3; $row++){
    echo "<p><b>Row number $row <p><b>";
    echo "<ul>";
    for ()
}*/

?>



<?php
/*$phones = array(
    array("Iphone 14", 20, 10),
    array("Iphone 13", 20, 20),
    array("Iphone 12", 20, 25)
    );
    echo $phones[0][0].". In stock:" echo $phones[1][0].. "In stock" echo $phones [2][0]. "In stock":
    for ($row = 0; $row<3; $row++){
    $phones e[1] "Sphones" [1][1] $phones [2][1]
    echo "<p><b>Row number $row </b><p>"; echo "<ul>";
    for($col-8; $col<3; $col++){
    }
    echo "<li>", $phones[$row][$col]."</li>";
    echo "</ul>";
    */

    ?>


<?php


$grade = array(
    "Math" => "3",
    "Art" => "5",
    "History" => "4",
    "Music" => "5",
);

// $grade = ['Math'] = "3",
// $grade = ['art'] = "5",
// $grade = ['history'] = "4",
// $grade = ['muzic'] = "5",

echo "Math grade is " . $grade['Math'] . "<br>";

foreach($grade as $subject => $grade_value){
    echo "Subject: " . $subject . ", Grade: " . $grade_value;
    echo "<br>";+
}



?>

<?php
$filename = "example.txt";
$file = fopen($filename, "w"); 

if ($file) {
    fwrite($file, "This is a new file created in write-only mode.\n");
    fclose($file);
} else {
    echo "Failed to open the file for writing.";
}




$my_file = fopen(filename: "ds.text", mode: 'r'); //..other code
fclose(stream: $my_file);
//fread

//set the name of file to be opened
$my_filename = "ds.txt";

//open the file for reading
$my_file = fopen(filename: $my_filename, mode: 'r');

//get the size of the file
$my_size = filesize(filename: $my_filename);

//Read the contents of the file into a variable
$my_filedata = fread(stream: $my_file, length: $my_size);



?>


<?php$my_file = fopen(filename: "ds.text", mode: 'r'); //..other code
fclose(stream: $my_file);
//fread

//set the name of file to be opened
$my_filename = "ds.txt";

//open the file for reading
$my_file = fopen(filename: $my_filename, mode: 'r');

//get the size of the file
$my_size = filesize(filename: $my_filename);

//Read the contents of the file into a variable
$my_filedata = fread(stream: $my_file, length: $my_size);


//feof
//Open the file 'example.txt' for reading using the fopen function
$file = fopen(filename: 'example.txt', mode: 'r');
//use a while loop to read each line of the file using fgets and print it to the screen with echo while(!feof(stream: $file)){

echo fgets(stream: ($file), length: "<br>");
// Close the file using fclose
fclose(stream: $file);

//fwrite
$my_file1 = fopen(filename: 'ds.txt', mode: 'w');
//Set the text to be written to the le
$my_text = "Digital School";



fwrite(stream: $my_filel, data: $my_text);
//file_put_contents
//Create a new file and add text
file_put_contents(filename: 'test.txt', data: 'Add some text in here');
echo file_get_contents(filename: 'test.txt');

?>



