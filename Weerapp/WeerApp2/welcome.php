<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>
    <p>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
    
<?php
require_once "config.php";
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// check if location exists
if (!empty($_POST['plaatsnaam'])){
    // Attempt insert query execution
    $plaatsnaam = trim(mysqli_real_escape_string($link, $_POST['plaatsnaam']));
    $sql = "SELECT idLocaties, locatie FROM locaties WHERE locatie = '$plaatsnaam' LIMIT 1";
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) == 0){
        $sql = "INSERT INTO locaties (locatie) VALUES('$plaatsnaam')";
        if(mysqli_query($link, $sql)){
            echo "Records added successfully.";
            echo "<br>Het id van $plaatsnaam is" . mysqli_insert_id($link);
        } 
        else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    } else {
        // get idLocaties
        $row = mysqli_fetch_assoc($result);
        echo "Het id van $plaatsnaam is " . $row['idLocaties'];
        $idlocaties = $row['idLocaties'];
        $idgebruiker = $_SESSION["id"];
        // check if location for this user exists
        $sql = "SELECT * FROM gebruiker_locaties_maps WHERE Locaties_idLocaties = $idlocaties AND Gebruiker_idGebruiker = $idgebruiker";
        // echo "$sql";
        // run query
        $result = mysqli_query($link, $sql);
        // get number of results
        if (mysqli_num_rows($result) == 0) // no results
        {
            // add location for this user
            $sql = "INSERT INTO gebruiker_locaties_maps VALUES($idgebruiker,$idlocaties)";
           // echo "$sql";
           if(mysqli_query($link, $sql)){
                echo "Locatie toegevoegd voor gebruiker";
            }
            else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }
        }
    }

    
    // get id of location from db
        // $sql = "SELECT * FROM locaties WHERE idLocaties";

    // get id of user from db
        // $sql = "SELECT * FROM gebruiker WHERE idGebruiker";

    // check if combination of user and location exists in db
        // $sql = "SELECT * FROM   gebruiker_locaties_maps
        // WHERE  NOT EXISTS (SELECT * FROM gebruiker, locaties
        //                     WHERE   Gebruiker_idGebruiker = idGebruiker AND
        //                     Locaties_idLocaties = idLocaties)";
                        
        // $sql = "SELECT * FROM   gebruiker_locaties_maps
        //     WHERE  NOT EXISTS (SELECT * FROM gebruiker, locaties 
        //                         WHERE   Gebruiker_idGebruiker = Locaties_idLocaties AND
        //                         Gebruiker_idGebruiker = Locaties_idLocaties)";

        // $sql = "SELECT * FROM   gebruiker_locaties_maps
        //      WHERE  NOT EXISTS (SELECT * FROM gebruiker, locaties
        //                          WHERE   Gebruiker_idGebruiker = username AND
        //                          Locaties_idLocaties = locatie)";

    // if it doesn't exist add it
    

}

?>
    <form action='welcome.php' method='post'>
        <div class="form-group">
            <label>Plaats</label>

            <?php
                    require_once "config.php";

                    $result = mysqli_query($link,'SELECT locatie FROM locaties ORDER BY idLocaties DESC LIMIT 1');
                    
                    $row = mysqli_fetch_array($result);
                    $locatie = trim($row['locatie']);
                    echo "<input type='text' name='plaatsnaam' class='form-control' value='$locatie'>"
            ?>
            <input type="submit" class="btn btn-primary" value="Submit">
        </div>
    </form>
</body>
<?php
require_once "config.php";
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$idgebruiker = $_SESSION["id"];
//$sql = "SELECT * FROM locaties ORDER BY idLocaties DESC LIMIT 5";

// haal de namen van de locaties van die gebruiker op
// select locatienaam, idlocatie
// from locaties, locaties_maps
// where  tabel.kolom = tabel.kolom AND idgebruiker = $idgebruiker;

$sql = "SELECT idLocaties, locatie
FROM locaties, gebruiker_locaties_maps
WHERE locaties.idLocaties = gebruiker_locaties_maps.Locaties_idLocaties
AND Gebruiker_idGebruiker = $idgebruiker";



$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "Plaats:" . $row["locatie"] ."<a href='delete.php?id=" . $row['idLocaties']  .  "'>delete</a>" . "<br>";
        // maak een link naar delete.php zet het id van de locatie in de link, zorg ervoor dat de locatie voor die gebruiker wordt verwijderd in delete.php
    }
} else {
    echo "0 results";
}
// Close connection
mysqli_close($link);
?>
</html>