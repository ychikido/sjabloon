<?php
// Include config file
session_start();
require_once "config.php";

$id = (int)$_GET['id'];
$idgebruiker = $_SESSION["id"] ?? 0;

$sql="DELETE FROM gebruiker_locaties_maps WHERE Locaties_idLocaties = $id AND Gebruiker_idGebruiker = $idgebruiker LIMIT 1";

$result=mysqli_query($link,$sql);

//check if query successful 
if($result){
    echo "Successful";
}

else {
    echo $sql;
    echo "<br>ERROR";
}

mysqli_close($link);
?>