<?php
require 'functions.php';
session_start();


if(!isset($_POST['submit'])){
    $barang = query("SELECT * FROM jual");
}
else{$sort = $_POST['sort'];
    if($sort === "Product name ASC"){
        $barang = query("SELECT * FROM jual ORDER BY product ASC");
    }
    else if($sort === "Product name DESC"){
        $barang = query("SELECT * FROM jual ORDER BY product DESC");
    }
    else if($sort === "Date item ASC"){
        $barang = query("SELECT * FROM jual ORDER BY timestamp ASC");
    }
    else{
        $barang = query("SELECT * FROM jual ORDER BY timestamp DESC");
    }
}
?>




<?php


    if(isset($_SESSION["login"])){
        header("Location: product.php");
        exit;
    }
   
    if(isset($_POST["login"])){
        $sId = $_POST["sId"];
        $password = $_POST["password"];
        $cariId = mysqli_query($conn, "SELECT * FROM users WHERE sId = '$sId'");
        if(mysqli_num_rows($cariId) ===1){
            //cek password
            $row = mysqli_fetch_assoc($cariId);
            if(password_verify($password, $row["password"])){
                
                $_SESSION["login"] = true;
                header("Location: product.php");
                exit;
            }
            else{
                echo "<script>
                    alert('Student id atau password salah!');
                </script>";
            }
        }
        else{
            echo "<script>
                alert('Student id atau password salah!');
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
    <link rel = "stylesheet" href = logins.css>

</head>

<body>
    <div class="header">
        <h1>KANTIN KEJUJURAN</h1>
        <!-- <a href = login.php><img src = "login.jpg" width = 40px height =40px></a>  -->
        <ul>
            <li> <a href = "home.php"> Home </a></li>
            <!-- <li> <a href = "sell.php"> Start selling </a></li>
            <li> <a href = "balance.php"> Balance </a></li>
            <li> <a href="logout.php">Logout</a></li> -->
        </ul>
    </div>
    <div class="container">
        <div class="welcome">
            <img src = "img/welcome.jpg" width = 200px>
        </div>
        <div class="login">
            <h2> LOGIN </h2>
            <form METHOD = POST action = "">
                <table cellspacing = 15px>
                    <tr>
                        <td><label for = "sId">Student ID</label></td>
                        <td>:</td>
                        <td><input type = text name = "sId" id = "sId"></td>
                    </tr>
                    <tr>
                        <td><label for = "password">Password</label></td>
                        <td>:</td>
                        <td><input type = password name = "password" id = "password"></td>
                    </tr>

                </table>
                <button type = "submit" name = "login">Login</button>
    
            

            </form>
            <hr class = "hr1" width = 40%>
            <font color = 'lightgrey'>atau</font>
            <hr class = "hr2" width = 40%>
           
            <font color = "grey">Baru di kantin kejujuran?</p>
            <a href = "register.php">Register</a>
        </div>
    </div>

    <div class="produk">
       <form action="" method = post>
            <label for="sort">Sort by: </label>
            <select name="sort" id="sort">
                <option value = "Product name ASC">Product name ASC </option>
                <option value = "Product name DESC">Product name DESC </option>
                <option value = "Date item ASC">Date item ASC </option>
                <option value = "Date item DESC">Date item DESC </option>
            </select>
            <button type = submit name = 'submit'>SORT</button>
       </form>
        <?php foreach($barang as $row) : ?>

            <div class="wadah" style = 'shadow:2px; margin :10px 3px 5px 3px'>
                <p style = 'font-size:10px; text-align:left; margin: 3px'><?php echo $row["timestamp"]; ?> </p>
                <img src = "img/<?= $row["image"]; ?>" width=180px height = 180px><br>
                <p style = 'font-family: Franklin Gothic Medium'><?php echo $row["product"]; ?> </p><br>
                <?php $_SESSION["keterangan"] = $row["price"]; ?> <br>
                <?php echo $row["desc"]; ?> <br>
                <br>
                <a href="buy.php?id=<?= $row['id']; ?>">Buy item!</a>

            </div>
        
        <?php endforeach; ?>
    </div>
</body>
</html>
