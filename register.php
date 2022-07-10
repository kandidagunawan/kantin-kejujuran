<?php
require 'functions.php';
if(isset($_POST["register"])){
    if(register($_POST) > 0){
        echo "<script> 
            alert('User baru berhasil ditambahkan!');
            </script>";
        
    }
    else{
        echo " <script> 
                alert('User baru gagal ditambahkan!');
                </script>";
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
    <link rel = "stylesheet" href = register.css>

</head>

<body>
    <div class="header">
        <h1>KANTIN KEJUJURAN</h1>
        <!-- <a href = login.php><img src = "login.jpg" width = 40px height =40px></a>  -->
        <ul>
            <li> <a href = "login.php"> Home </a></li>
            <li> <a href = "sell.php"> Start selling </a></li>
            <li> <a href = "balance"> Balance </a></li>
            <li> <a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="register">
        <h2> REGISTER </h2>
        <form METHOD = POST ACTION = "">
            <table cellspacing = 15px>
                <tr>
                    <td><label for= "sId"> Student ID </label></td>
                    <td>:</td>
                    <td><input type = text name = "sId" id = "sId"></td>
                </tr>
                <tr>
                    <td><label for= "password1">Password </label></td>
                    <td>:</td>
                    <td><input type = password name = "password1" id = "password1"></td>
                </tr>
                <tr>
                    <td><laberl for = "password2"> Password validation </label></td>
                    <td>:</td>
                    <td><input type = password name = "password2" id = "password2"></td>
                </tr>

            </table>
            <button type = "submit" name = "register">REGISTER</button>
            <!-- <input type = "reset" value = 'RESET'> -->
            <button type = "reset" name = "reset">RESET</button>

        </form>
    </div>

</body>
</html>