<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Validation System</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<h2 align= center><b>SOAP API İLE E-DEVLET KİMLİK KONTROLÜ </b></h2>


<div class="form">
<form action= "" method="POST">
        <input type="text" name="tcno" placeholder="T.C. Kimlik Girin"><br>
        <input type="text" name="ad" placeholder="AD"><br>
        <input type="text" name="soyad" placeholder="SOYAD"><br>
        <input type="text" name="dogum" placeholder="DOĞUM YILI"><br>
        <button type="submit" name="gonder">Giriş Yap</button><br>
</form>
</div>



<?php




session_start();
require_once 'connection.php';

if (isset($_SESSION['tcno'])) { 
    header('Location: index.php');
}



if($_SERVER["REQUEST_METHOD"] == "POST"){
    $tcno = $_POST["tcno"];
    $firstname  = $_POST["ad"];
    $lastname = $_POST["soyad"];
    $birthyear = $_POST["dogum"];

   
    try {
        

        $request = new SoapClient('https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL');
        

        $result = $request->TCKimlikNoDogrula(array(
            'TCKimlikNo' => $tcno,
            'Ad' => $firstname,
            'Soyad' => $lastname,
            'DogumYili' => $birthyear)
        );
        

        if ($result->TCKimlikNoDogrulaResult) {
            $sql = "insert into users(tcno, ad, soyad, dogum) values ('$tcno','$firstname', '$lastname', '$birthyear')";
            $dbconn = mysqli_query($conn, $sql);
            


            $levelquery = "SELECT * FROM users WHERE tcno='$tcno'";
            $results = mysqli_query($conn, $levelquery);
    
            if (mysqli_num_rows($results) == 1) {
                $logged_in_user = mysqli_fetch_assoc($results);
                
                /*session_start();*/
                $_SESSION['tcno'] = $logged_in_user['tcno'];
            
                if (isset($_SESSION['tcno'])) { 
                    if($logged_in_user['level'] == '1') {
                        header('Location: admin.php');
                    }
                    else{
                        header('Location: index.php');
                    }
                }
            }
            
                
               
        }
        else {
            echo "<p align= center>böyle bir kişi yok tekrar dene </p>";
        }

    } catch (Exception $exc) {

        echo $exc->getMessage();
    }

}


?>


</body>
</html>