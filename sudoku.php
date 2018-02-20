<?php
define("TARGET_SUM", 405);  // Sum of all cells values in solved SUDOKU


function display($array){
    $display="\n";
    $display.="           1   2   3    4   5   6    7   8   9\n\n";
    $display.="          _____________________________________ \n";
    foreach ($array as $key=>$subArray){
        $display.="   ".$key."     ";
        
        foreach ($subArray as $key2=>$cell){
            
            if (($key2==4)||($key2==7)) $display.="|".(($cell)?("| ".$cell." "):"|   ");
            else $display.="|".(($cell)?(" ".$cell." "):"   ");
        }
        $display.="|";
        $display.= "\n";
        if (($key==3)||($key==6)) $display.="         |===|===|===||===|===|===||===|===|===|\n";
        else $display.="         |___|___|___||___|___|___||___|___|___|\n";
    }
    return $display;
}

function multi_array_sum($array){  // Сounting the sum of the values ​​of all entered cells
    $sum=0;
    foreach ($array as $subarray) $sum+=array_sum($subarray);
    return $sum;
}

function total_check($value, $array, $line, $column){
    if (line_check($value, $array, $line)){
        if (column_check($value, $array, $column)){
            if (square_check($value, $array, $line, $column)) return true;
        }
    }
    else return false;
}

function line_check($value, $array, $line){
    if (in_array($value, $array[$line])) return false;
    else return true;
}

function column_check($value, $array, $column){
    $checkArray=[];
    foreach ($array as $element){
        array_push($checkArray, $element[$column]);
    }
    if (in_array($value, $checkArray)) return false;
    else return true;
}

function square_check($value, $array, $line, $column){
    switch (true){
        case ($column<=3): $column=1;
        break;
        case ($column<=6): $column=4;
        break;
        case ($column<=9): $column=7;
        break;
    }
    
    switch (true){
        case ($line<=3): $line=1;
        break;
        case ($line<=6): $line=4;
        break;
        case ($line<=9): $line=7;
        break;
    }
    $column1=$column;
    $checkArray=[];
    for ($i=0; $i<3; $i++, $line++){
        for ($n=0; $n<3; $n++, $column1++){
            array_push($checkArray, $array[$line][$column1]);
        }
        $column1=$column;
    }
    if (in_array($value, $checkArray)) return false;
    else return true;
}

function hidecells($array, $difficult){
    foreach ($array as &$subArray){
        $randomArray=[];
        while (count($randomArray)<$difficult){
            $randomCell=rand(1, 9);
            if (!(in_array($randomCell, $randomArray))){
                array_push($randomArray,$randomCell);
                $subArray[$randomCell]="";
            }
        }
    }
    return $array;
}

function is_correct_level($number){
    if (is_numeric($number)){
        if (($number>=1)&&($number<=3)) return $number;        
    }
    else return false;
}

function is_correct($number){
    if (is_numeric($number)){
        if (($number>=1)&&($number<=9)) return $number;
        else return false;
    }
    else return false;
}


function readconsole(){
    $handle=fopen("php://stdin", "r");
    $number=intval(fgets($handle));
    return $number;
}

function is_entered($array, $line, $column){
    if ($array[$line][$column]) return true;
    else return false;
}

$originField=[1=>[1=>"", 2=>"", 3=>"", 4=>"", 5=>"", 6=>"", 7=>"", 8=>"", 9=>""],
    2=>[1=>"", 2=>"", 3=>"", 4=>"", 5=>"", 6=>"", 7=>"", 8=>"", 9=>""],
    3=>[1=>"", 2=>"", 3=>"", 4=>"", 5=>"", 6=>"", 7=>"", 8=>"", 9=>""],
    4=>[1=>"", 2=>"", 3=>"", 4=>"", 5=>"", 6=>"", 7=>"", 8=>"", 9=>""],
    5=>[1=>"", 2=>"", 3=>"", 4=>"", 5=>"", 6=>"", 7=>"", 8=>"", 9=>""],
    6=>[1=>"", 2=>"", 3=>"", 4=>"", 5=>"", 6=>"", 7=>"", 8=>"", 9=>""],
    7=>[1=>"", 2=>"", 3=>"", 4=>"", 5=>"", 6=>"", 7=>"", 8=>"", 9=>""],
    8=>[1=>"", 2=>"", 3=>"", 4=>"", 5=>"", 6=>"", 7=>"", 8=>"", 9=>""],
    9=>[1=>"", 2=>"", 3=>"", 4=>"", 5=>"", 6=>"", 7=>"", 8=>"", 9=>""]];


function makesudoku(&$originField, $difficult){
    $field=$originField;     
    while((multi_array_sum($field))<TARGET_SUM){
        $field=$originField;
        for ($line=1; $line<=9; $line++){
            for ($column=1; $column<=9; $column++){
                if ($field[$line][$column]) continue;
                else {
                    for ($i=1; (!($field[$line][$column])); $i++ ){
                        if ($i>100) break 3;
                        else {
                            $value=rand(1, 9);
                            if (total_check($value, $field, $line, $column)){
                                $field[$line][$column]=$value;
                            }
                        }
                    }
                    
                }
                
            }
            
        }
        if (multi_array_sum($field)==TARGET_SUM){            
            break;            
        }        
    }
    $originField = hidecells($field, $difficult);
    return $originField;
}

function playsudoku(&$field){
    echo display($field)."\nLets play!\n";
    while((multi_array_sum($field))<TARGET_SUM){
        $correctCell=false;
        while ($correctCell==false){
            $lineCorrect=false;
            while ($lineCorrect==false){
                echo "Enter the line's number of cell <1-9>:\n";
                $line= readconsole();
                if (is_correct($line)){
                    $lineCorrect=true;
                }
                else {
                    echo "Incorrect chat. Try again...  ";
                    $lineCorrect=false;
                }
            }
            $columnCorrect=false;
            while ($columnCorrect==false){
                echo "Enter the column's number of cell <1-9>:\n";
                $column= readconsole();
                if (is_correct($column)){
                    $columnCorrect=true;
                }
                else {
                    echo "Incorrect chat. Try again...  ";
                    $columnCorrect=false;
                }
            }
            
            if (!(is_entered($field, $line, $column))){
                $correctCell=true;
            }
            else {
                echo "This cell is already entered. Please choose empty cell\n";
            }
        }
        
        $validValue=0;
        while ($validValue<3){  //Each of the cheking functions adding one point to $validValue
            $correctValue=false;
            while ($correctValue==false){
                echo "Choose value you want enter to the cell\n";
                $value=readconsole();
                if (is_correct($value)){
                    $correctValue=true;
                }
                else {
                    echo "Incorrect char. Try again...  ";
                }
            }
            if (line_check($value, $field, $line)){
                $validValue=1;
                if (column_check($value, $field, $column)){
                    $validValue+=1;
                    if (square_check($value, $field, $line, $column)){
                        $validValue+=1;
                    }
                    else echo "You already have such value on this square...\n";
                }
                else echo "You already have such value on this column...\n";
            }
            else echo "You already have such value on this line...\n";
        }
        $field[$line][$column]=$value;
        echo display($field).PHP_EOL;
    }
    Echo "Congratulations!!! You solved this SUDOKU!";
    
}

$difficult = [1 => 3, 2 => 5, 3=> 6];
echo "Choose difficult level <1-3>, where\n1-Newbie\n2-Normal\n3-Hard\n";
$level = "";
while (!($level)){
    $level = is_correct_level(readconsole());
}
makesudoku($originField, $difficult[$level]);
playsudoku($originField);
?>