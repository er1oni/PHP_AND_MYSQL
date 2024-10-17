<?php
// if statement, if...else statement, if...elseif...else statement, switch statement

// if statement
$num = 1;

if($num<0){
    echo "$num is less than 0 <br>" ;
}

// if...else
$age = 13;
if($age > 18){
    echo "You are an adult";
}else{
    echo "You are under 18 <br>";
}

if(($age > 12) && ($age < 20)){
    echo "Iscount for you!!!";    
}
    //if...elseif...else
    if($num<0){
        echo "The value $num is a negative number.";
    }elseif($num==0){
        echo "The value of $num is 0";
    }else{
        echo "The value of $num is a pozitive number. <br>";
    }



 
    $score = 100;
    

    if ($score >= 90 && $score <= 100) {
        $grade = 'A';
    }
     elseif ($score >= 80 && $score <= 89) {
        $grade = 'B';
    } 
    elseif ($score >= 70 && $score <= 79) {
        $grade = 'C';
    } 
    elseif ($score >= 60 && $score <= 69) {
        $grade = 'D';
    } 
    else {
        $grade = 'F';
    }
    
    echo "The grade for a score of $score is: $grade <br>";


    $grade = 'B';
    switch($grade){
        case 'A';
            echo 'Exellent you gor an A!';
            break;
        case 'B':
            echo 'good job jou got an B!';
            break;
        case 'C':
        echo 'Welldone! you got a c!';
            break;
        case 'D':
        echo 'Welldone! you got a D!';
            break;
        case 'F':
        echo 'Welldone! you got a F!';
            break;
        default:
        echo 'Invalid value';
        break;             
                    
    }    
    

    

?> 