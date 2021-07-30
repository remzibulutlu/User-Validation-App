

<?php 

require_once 'connection.php';


session_start();
if(isset($_SESSION["tcno"])){

    echo "<p align=center>TEBRİKLER, HALA YAŞIYORSUN :D</p><br>";

    echo '<p align = center><iframe width="450" height="350" src="https://www.youtube.com/embed/SFV1p-MdGwo"></iframe></p>';
    
    echo '<form align = center action="logout.php" method="post"><button type="submit" name="logout-submit">Logout</button></form>';
    
}
else{
    header("Location:soap-service.php");
}       

?>
