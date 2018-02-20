<?php
chdir(dirname(__FILE__));
$handle=fopen("php://stdin", "r");
$arrayInput=file("Input.txt");
Echo "\nThis is the source data from the file\n";
print_r($arrayInput);
titling($arrayInput);
print(cases($title));
$sort=intval(trim(fgets($handle)))-1;
$number=$title[$sort];
usort($db, function($a, $b) {
    global $number;
    return $a[$number] <=> $b[$number];
});
print_r($db);
function titling($arrayInput){
    global $db;
    for ($n=1; $n<count($arrayInput); $n++){
        global $title;
        $title=explode(";", $arrayInput[0]);
        $profValue=explode(";", $arrayInput[$n]);
        $profile=[];
        for ($i=0; $i<count($title); $i++){
            $profile+=[trim($title[$i])=>"$profValue[$i]"];    
        }        
        $db[$n]=$profile;                
    }
    return $db;
}
function cases($array){
    for ($i=0; $i<count($array); $i++){        
        $titleName=trim($array[$i]);
        $chooseNumber=$i+1;
        $message.="If you want sort data by $titleName      Enter: $chooseNumber \n";        
    }
    return $message;
}

?>