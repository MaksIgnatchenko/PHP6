<?php
$winner="";
$a=$b=$c=$d=$e=$f=$g=$h=$j=" ";
$mark=[&$a, &$b, &$c, &$d, &$e, &$f, &$g, &$h, &$j];
$combo1=[&$mark[0], &$mark[1], &$mark[2]];
$combo2=[&$mark[3], &$mark[4], &$mark[5]];
$combo3=[&$mark[6], &$mark[7], &$mark[8]];
$combo4=[&$mark[0], &$mark[4], &$mark[8]];
$combo5=[&$mark[2], &$mark[4], &$mark[6]];
$combo6=[&$mark[0], &$mark[3], &$mark[6]];
$combo7=[&$mark[2], &$mark[5], &$mark[8]];
$winX=["X", "X", "X"];
$winO=["O", "O", "O"];
echo "Lets play!\т";
for ($turn=1; $turn<=9; $turn++  ){
    if ($turn%2) $char="X";
    else $char="O";
    display();    
    echo "\n $char Player's turn\n";
    $mark[readconsole()]=$char;
    echo "\n";
    if (iswin()){
        display();
        echo "\n".$winner;
        break;
    }
    if ($turn==9) echo "It is PAT !!!\n Try again!";
        
}

function display(){
    global $a, $b, $c, $d, $e, $f, $g, $h, $j;
    $message = <<<EOF
        
        PLAYING FIELD              INFO
    
          |     |                |     |
       $a  |  $b  |  $c          1  |  2  |  3
     _____|_____|_____       ____|_____|____   
          |     |                |     |
       $d  |  $e  |  $f          4  |  5  |  6  
     _____|_____|_____       ____|_____|____
          |     |                |     |
       $g  |  $h  |  $j          7  |  8  |  9 
          |     |                |     |
          
EOF;
    return print($message);
}

function readConsole(){
    global $mark;
    $handle=fopen("php://stdin", "r");
    $choice=((int)(trim(fgets($handle))))-1;    
    fclose($handle);
    if (($choice<0)||($choice>9)){
        echo "Incorect char. Try again!\n";
        $choice=readconsole();
    }
    if (($mark[$choice]=="O")||($mark[$choice]=="X")){
        echo "This cell is already taken. Choose another\n";
        $choice=readconsole();
    }
    return $choice;
}

function iswin(){
    global $mark, $combo1, $combo2, $combo3, $combo4, $combo5, $combo6, $combo7, $winX, $winO, $winner;
    for ($i=1, $result=""; $i<=7; $i++){               
        if (${"combo".$i}===$winX){
            $winner="Win X player!!!";
            $result.="1";           
            
        }
        else $result.="";
        if (${"combo".$i}===$winO){
            $winner="Win O player!!!";
            $result.="1";
        }
        else $result.="";
    }
    if ($result) return true;
    else return false;
}
?>
