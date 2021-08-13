<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Validation System</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<h2 align= center><b>kullanıcı ekle </b></h2>


<div class="form">
<form action= "" method="POST">
        <input type="text" name="tcno" placeholder="T.C. Kimlik Girin"><br>
        <input type="text" name="ad" placeholder="AD"><br>
        <input type="text" name="soyad" placeholder="SOYAD"><br>
        <input type="text" name="dogum" placeholder="DOĞUM YILI"><br>
        <button type="submit" name="gonder">Kullanıcı Ekle</button><br>
</form>
<form align=center action="admin.php" method="">
        <button type="submit" >Admin Sayfasına Geri Dön</button></form>
</form>
</div>

<?php
session_start();
require_once 'connection.php';


if (!isset($_SESSION['tcno'])) { 
    header('Location: soap-service.php');
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

            header("Location: admin.php");
        }
        else{
            echo '<p align = center> böyle bir kullanıcı yok, kayıt olarak ekleyemezsin !!</p>';
        }
    }
    catch (Exception $exc) {

    echo $exc->getMessage();
    }
}
?>

</body>
</html>