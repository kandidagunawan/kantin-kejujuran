<?php
session_start();
require 'functions.php';
if(!isset($_SESSION["login"])){
    
    header("Location: index.php");

}

if(isset($_POST["submit"])){

    if(tambah($_POST) > 0){
        echo "
            <script> 
                alert('Anda berhasil menjual barang!');
                document.location.href = 'product.php';

            </script>
        
        ";
    }
    else{
        echo "<script> 
        alert('Anda gagal menjual barang!');
        document.location.href = 'product.php';

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
        <h2>START SELLING ITEMS</h2>
        <form action = "" method = "POST" enctype = "multipart/form-data">
            <table cellspacing = 15px>
                <tr>
                    <td><label for = "product">Product name</label></td>
                    <td>:</td>
                    <td><input type = text name = "product" id = "product" required></td>
                </tr>
                <tr>
                    <td><label for = "image">Product image </label> </td>
                    <td>:</td>
                    <td><input type = "file" id = "image" name = "image" required></td>
                </tr>
                <tr>
                    <td><label for = "price">Price </label></td>
                    <td>:</td>
                    <td><input type = text name = "price" id = "price" required></td>
                </tr>
                <tr>
                    <td><label for = "desc">Description </label></td>
                    <td>:</td>
                    <td><textarea name = "desc" id = "desc"required> </textarea></td>
                </tr>
                
            </table>
           
            <button type = "submit" name = "submit">Start selling!</button>

           
            
        </form> 
        
    </div>


    <!-- <script>
        alert("Hello World!");
    </script>     -->
    <!-- <script src = "latihan.js"> </script> -->
</body>
</html>
