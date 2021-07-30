<?php

require_once 'connection.php';


session_start();

if (isset($_SESSION['tcno'])){
?>


        <div class="list-users" align= center>
              <table class="table">
                <thead>
                  <?php
                    $sqllist = 'select * from users';
                    $listresult = mysqli_query($conn, $sqllist);
                    /*$listeduser = mysqli_fetch_assoc($listresult);*/
                    
                  ?> 
                  <tr>
                    
                    <th scope="col">TC</th>
                    <th scope="col">İsim</th>
                    <th scope="col">Soyisim</th>
                    <th scope="col">Doğum Yılı</th>
                    
                  </tr>
                </thead>

                <tbody>
                  <?php foreach($listresult as $userlist){ ?>
                    
                  <tr>
                  
                    <td><?php echo $userlist['tcno'] ?></td>
                    <td><?php echo $userlist['ad'] ?></td>
                    <td><?php echo $userlist['soyad']?></td>
                    <td><?php echo $userlist['dogum'] ?></td>
                    <!--<td><form action="delete.php" method="POST">
                    <button type="submit" name="delete-submit">Delete User</button></form></td>-->
                  </tr>
                  <?php } ?>

                </tbody>
              </table>
            </div>
        
<?php

    echo '<br><form align=center action="add.php" method="">
            <button type="submit" >Add User</button></form>';
    
    echo '<form align=center action="delete.php" method="">
            <button type="submit" >Delete User</button></form><br>';
    
    echo '<br><form align=center action="index.php" method="">
            <button type="submit" >Go to Index Page</button></form>';


    echo '<form align=center action="logout.php" method="post">
            <button type="submit" >Logout</button></form>';

}

else{
    header("Location: soap-service.php");
}
