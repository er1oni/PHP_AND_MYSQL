<?php
$sport = array('Football', 'Basketball', 'Handball', 'Volleyball');

// First slice: from index 2 to the end of the array
$output1 = array_slice($sport, 2);

// Second slice: 1 element starting from the second-to-last element
$output2 = array_slice($sport, -2, 1);

// Third slice: first 3 elements of the array
$output3 = array_slice($sport, 0, 3);

// Display all the slices
var_dump($output1, $output2, $output3);
?>
