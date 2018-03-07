<?php
//Separate text file by words and inputed it to db
$pathToFile = ""; // Path to your file you want input to db
$tableName = "";                    // Table name you want create 
$hn = '';                             // Your hostname 
$db = '';                            // Your database name
$un = '';                                // Your username to login
$pw = '';                           // Your password 
$handle = fopen($pathToFile, "r");
try {
    $pdo = new PDO("mysql:host=$hn;dbname=$db", $un, $pw);
}
catch (PDOException $e) {
    echo "Connection is not completed";
}
$query = "create table $tableName (id int(6) not null primary key auto_increment, word varchar(100) not null default '');";
$ver = $pdo->query($query);
while (!feof($handle)){
    $string = fgets($handle);
    $stringArray = explode(" ", $string);
    $count = count($stringArray);
    for ($i = 0; $i < $count; $i++){
        $word = strtolower(preg_replace("/[^A-Za-z]/", "", $stringArray[$i]));                    
        if ($word != ""){
            $query = "insert into $tableName (word) values ('$word')";
            $ver = $pdo->query($query);
        }         
    }     
}
fclose($handle);
