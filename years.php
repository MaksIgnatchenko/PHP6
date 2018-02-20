<?php
echo "Enter please any four-digit year's number\n";
$handle=fopen("php://stdin", "r");
$year=array_map("intval", str_split(trim(fgets($handle))));
$quant1=["", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine"];
$quant2=["", "", "twenty", "thirty", "forty", "fifty", "sixty", "seventy", "eighty", "ninety"];
$ordinal1=["", "first", "second", "third", "fourth", "fifth", "sixth", "seventh", "eighth", "nineth"];
$ordinal2=["", "eleventh", "twelfth", "thirteenth", "fourteenth", "fifteenth", "sixteenth", "seventeenth", "eighteenth", "nineteenth"];
$ordinal3=["","tenth", "twentieth", "thirtieth", "fortieth", "fiftieth", "sixtieth", "seventieth", "eightieth", "ninetieth"];
$order=[" thousand ", " houndred ", " ", " ",];
for ($i=0; $i<count($year); $i++){
    if ($i==0){
        $array=(($year[1]+$year[2]+$year[3])>0)?$quant1:$ordinal1;
        $n=$year[$i];
        $ord=($year[$i]>0)?$order[$i]:null;
        $numeral[$i]="$array[$n]".$ord;
    }
    if ($i==1){
        $array=(($year[2]+$year[3])>0)?$quant1:$ordinal1;
        $n=$year[$i];
        $ord=($year[$i]>0)?$order[$i]:null;
        $numeral[$i]="$array[$n]".$ord;        
    }
    if ($i==2){
        if  ($year[3]===0){
            $array=$ordinal3;
            $n=$year[$i];
            $numeral[$i]="$array[$n]";
        }
            else {
                if ((((int)("$year[2]"."$year[3]"))>10)&&(((int)("$year[2]"."$year[3]"))<19)){
                    $n=$year[3];
                    $array=$ordinal2;
                    $numeral[$i]="$array[$n]";
                }
                else {
                    $n=$year[$i];
                    $array=$quant2;
                    $numeral[$i]="$array[$n]";
                }
            }
    }
    if ($i==3){
        if ((((int)("$year[2]"."$year[3]"))>10)&&(((int)("$year[2]"."$year[3]"))<19)){
            $numeral[$i]="";
        }
        else {
            $n=$year[$i];
            $array=$ordinal1;
            $numeral[$i]="$array[$n]";
        }
    }
}
echo "\n$numeral[0]"."$numeral[1]"."$numeral[2] "."$numeral[3]"." year";
?>


