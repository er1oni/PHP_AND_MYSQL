<?php 


$sports = ['Football', 'Basketball', 'Handball', 'Voleyball']; 
$len = count($sports);
/*echo $sports[0];
    echo end($sports);
    echo count($sports);*/ 
for($i = 0; $i < $len; $i++) 
{ 
    echo $sports[$i], "\n"; 
} 

?>