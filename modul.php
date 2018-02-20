<?php
/*
* Function receives an array with integer numbers,
* should return its sum. It is not alowed to use built-in php functions.
*/

function my_sum($arr){
    $result = 0;
    foreach ($arr as $value){
        $result += $value;
    }
    return $result;
}

/*
* Function receives a long string with many words.
* It should return the same string, but words,
* larger then 6 symbols, should be changed, symbols
* after the sixth one should be replaced by symbol *
*/

function shortener($str){
    $arr = explode(" ", $str);
    $string = "";
    foreach ($arr as $value){
        if ((strlen($value))>6) $string .= substr($value, 0, 6)."*"." ";
            else $string .= $value." "; 
    }
    return rtrim($string);    
}

/*
* Function receives an array of strings.
* Please return number of strings, which
* length is at least 2 symbols and first character
* is equal to the last character
*/

function compare_ends($arr){
    $count = 0;
    foreach ($arr as $string){
        $first = $string[0];
        $last = $string[strlen($string)-1];               
        if (!(strcasecmp($first, $last)) && ((strlen($string)) >= 2)) $count++;
    }    
    return $count;
}

//* Function receives a string, should return this string reversed.

function reverse_string($str){
    $result="";
    for ($i = strlen($str)-1; $i >= 0; $i--){
        $result .= $str[$i];        
    }
    return $result;
}
