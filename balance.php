<?php
require 'functions.php';    
session_start();
if(!isset($_SESSION["login"])){
    
    header("Location: index.php");

}
if(isset($_POST["submit"])){
    if(tambahUang($_POST) > 0){
        echo "
            <script> 
                alert('Anda berhasil menambahkan/menarik uang dari kantin!');

            </script>
        
        ";
    }
    else{
        echo "<script> 
        alert('Anda gagal menambahkan/menarik uang dari kantin!');

        </script>
        ";
    }
 
            
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KANTIN KEJUJURAN</title>
    <link rel = "stylesheet" href = sell.css>

</head>

<body>
    <div class="header">
        <h1>KANTIN KEJUJURAN</h1>
        <!-- <a href = login.php><img src = "login.jpg" width = 40px height =40px></a>  -->
        <ul>
            <li> <a href = "index.php"> Home </a></li>
            <li> <a href = "sell.php"> Start selling </a></li>
            <li> <a href = "balance.php"> Balance </a></li>
            <li> <a href="logout.php">Logout</a></li>
            
        </ul>
       
    </div>

    <div class="sell">
        <h2>CANTEEN'S BALANCE</h2>
        <h3>Canteen's Balance now :  
            <?php 
                    $totalSementara1 = mysqli_query($conn, "SELECT total FROM moneyflow ORDER BY id DESC LIMIT 1");
                    $totalSementara2 = mysqli_fetch_assoc($totalSementara1);
                    $totalSementara3 = $totalSementara2['total'];
                 echo $totalSementara3 
            ?>
        </h3>
        <form action="" method = "post">
            <table cellspacing = 15px>
                <tr>
                    <td><label for="topup">Top up Canteen's Balance</label></td>
                    <td>:</td>
                    <td><input type="text" name = "topup" id = "topup" required></td>
                </tr>
                <tr>
                    <td><label for="withdraw">Withdraw from Canteen's Balance</label></td>
                    <td>:</td>
                    <td><input type="text" name = "withdraw" id = "withdraw" required></td>
                </tr>
                
            </table>
            <button type = "submit" name = "submit">Submit</button>
        </form>
    </div>
</body>
</html>
