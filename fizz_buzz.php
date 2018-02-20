<?php
chdir(dirname(__FILE__));
list($fizz, $buzz, $third) = 0; 
echo "\n\nThis script is named FIZZ_BUZZ v. 4.0\n";
echo "Please choose source of input data:\n";
echo "If you want input data from console: Choose <1>\n";
echo "If you want input data from file:     Choose <2>\n";
switch (readconsole()){
    case "1":{
        echo "Input integer values for FIZZ, BUZZ, THIRD NUMBER by enter\n";
        $input=getdata();
        list($fizz, $buzz, $third)= $input;
        $result1=array_map("algorithm", $array=range(1, $third));
        echo "\nResult: ".implode(" ", $result1);
    } 
    break;
    case "2": {
        echo "\nA file with three random numbers will be created, read and deleted!\n";
        echo "Input data:\nFIZZ:   $fizz\nBUZZ:   $buzz\nNUMBER: $third\nOUTPUT:
      The result is read from the file:\n\n";
        randomfile();
        $result1=readstrfile("fbdata.txt");
        writefile(implode(";", $result1));        
        $result1=array_map("algorithm", $array=range(1, $third));        
        echo "\nA file with three random numbers will be created, read and deleted!\n";
        echo "Input data:\nFIZZ:   $fizz\nBUZZ:   $buzz\nNUMBER: $third\nOUTPUT:\n";
        echo "The result is read from the file:(<fbdata.txt>)\n";
        echo implode(" ", $result1);
    }
    break;
    default: exit();
}

echo "\n\nDo you want compare this result with another result from the file?\n";
echo "If you want input path to your file:   Choose <1>\n";
echo "If you want use standart cheking file: Choose <2>\n";
echo "If you do not want to compare:         Choose <3>\n";
switch (readconsole()){
    case "1":{
        echo "\nInput path to your cheking file:\n";
        $path= readconsole();
        $result2= @readstrfile($path);        
        echo "Your result:    ".implode(" ", $result1)."\n";
        echo "Cheking result: ".implode(" ", $result2)."\n";
        echo "Compare:        ".compare($result1, $result2);
        
    }
    break;        
    case "2":{
        standartfile("1 F 3 F B F 7 F 9 FB 11 F 13 F B F 17 F");        
        $result2= @readstrfile("standart.txt");
        unlink("standart.txt");
        echo "Standard condition Fizz - 2, Buzz - 5M Third number -18\n"; 
        echo "Your result:    ".implode(" ", $result1)."\n";
        echo "Cheking result: ".implode(" ", $result2)."\n";
        echo "Compare:        ".compare($result1, $result2);
    }
    break;
    default: exit();
        
 

}

function readConsole(){
    $handle=fopen("php://stdin", "r");
    $choice=trim(fgets($handle));
    fclose($handle);
    return $choice; 
}

function algorithm($array){
    global $fizz, $buzz, $third;
    $result="";
    if ((!($array%$fizz)) || (!($array%$buzz))){
        if (!($array%$fizz)) $result.="F";
        if (!($array%$buzz)) $result.="B";
    }   else $result="$array";
    return $result;
}

function getdata(){     
    for ($i=0, $console=[]; $i<=2; $i++){
        $console[$i]= readConsole();         
    }
    
    return array_map(function ($a){settype($a, "integer"); return $a;}, $console);
}
  
function randomfile(){
    $handleW=fopen("fbdata.txt", "w");
    list($a, $b, $c)=[rand(1, 10), rand(1, 20), rand(15, 30)];
    fwrite($handleW, "$a $b $c");
    fclose($handleW);
    return 1;    
}
    


function writefile($a){
    $handleW=fopen("fbdata.txt", "w");    
    fwrite($handleW, "$a");
    fclose($handleW);
    return 1;
}

function readstrfile($p){
    global $fizz, $buzz, $third;
    $handle=fopen($p, "r");
    $input=array_map(function ($a){trim($a); return $a;},  explode(" ", fgets($handle)));
    list($fizz, $buzz, $third)= $input;
    fclose($handle);
    unlink("fbdata.txt");
    return $input;
    
}

function compare($a, $b){
    if ($a===$b) $message= "This results are equal";
        else  $message= "This results are not equal";
    return $message;
}

function standartfile($result){
    $handleS = fopen("standart.txt", "w");    
    fwrite($handleS, $result);
    fclose($handleS);    
}
?>