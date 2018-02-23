<?php
if (!isset($_POST['sub'])){
    echo <<<_FORM
        <!DOCTYPE html>
        <html>
        <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>Insert title here</title>
        </head>
        <body>
        <form method="post" action="form.php">        
                
            <div class="container">
                <h2>Your personal information</h2>
                <table class="table">
                <tr><td><label>Name</label></td><td><input type="text" name="inputs[Name]"><br></td></tr>
                <tr><td><label>Surname</label></td><td><input type="text" name="inputs[Surname]"><br></td></tr>
                <tr><td><label>Mobile</label></td><td><input type="text" name="inputs[Mobile]"><br></td></tr>
                <tr><td><label>E-mail</label></td><td><input type="text" name="inputs[Email]"><br></td></tr>
                <tr><td><input type="submit" name="sub" value="SEND"></td></tr>                    
                </table>
            </div>                       
                
            <div class="container">
                <h2>Tell please about your skills</h2>
                <table class="table">
                <tr><td style="something"><label>PHP</label></td><td><input type="checkbox" name="stack[php]" value="PHP"></td></tr>
                <tr><td><label>PYTHON</label></td><td><input type="checkbox" name="stack[python]" value="PYTHON"></td></tr>
                <tr><td><label>RUBY</label></td><td><input type="checkbox" name="stack[ruby]" value="RUBY"></td></tr>
                <tr><td><label>HTML</label></td><td><input type="checkbox" name="stack[html]" value="HTML"></td></tr>
                <tr><td><label>CSS</label></td><td><input type="checkbox" name="stack[css]" value="CSS"></td></tr> 
                <tr><td><label>JavaScript</label></td><td><input type="checkbox" name="stack[javascript]" value="JavaScript"></td></tr> 
                <tr><td><label>GIT</label></td><td><input type="checkbox" name="stack[git]" value="GIT"></td></tr> 
                <tr><td><label>SUBVERSION</label></td><td><input type="checkbox" name="stack[subversion]" value="SUBVERSION"></td></tr>                         
                </table>           
            </div>
        
        </form>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        </body>
        </html>
_FORM;
}
else {
    echo <<<_ANSWER
     <!DOCTYPE html>
    <html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Insert title here</title>
    </head>
    <body>
_ANSWER;
           
    if (count($_POST['inputs']) > 0){
        $inputs = array_map(function($var){
            $var = stripslashes($var);
            $var = strip_tags($var);
            $var = htmlentities($var);
            return $var;
        }, $_POST['inputs']);
            echo "<div class='container'><h2>Personal information</h2><table>";
            foreach ($inputs as $key=>$value){
                if ($value) echo  "<tr><td><p>$key</p></td><td><p>$value</p></td><tr>";
            }
            echo " </table></div>";
    }
    if (count($_POST['stack']) > 0){        
        $stack = array_map(function($var){
            $var = stripslashes($var);
            $var = strip_tags($var);
            $var = htmlentities($var);
            return $var;
        },  $_POST['stack']);
            echo "<div class='container'><h2>Skills</h2><table>";
            foreach ($stack as $value){
                if ($value) echo  "<tr><td><p>$value</p></td><tr>";
            }
            echo " </table></div>";
    }          
    
 
    echo <<<_ANSWER2
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
_ANSWER2;
    echo "</body></html>";
    
}
?>

                    
                       
   