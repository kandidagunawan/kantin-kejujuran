<?php
require 'functions.php';
session_start();

$barang = query("SELECT * FROM jual");
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KANTIN KEJUJURAN</title>
    <link rel = "stylesheet" href = products.css>

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

