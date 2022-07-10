<?php
$conn = mysqli_connect("localhost", "root", "", "contoh");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_array($result)){
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data){

    global $conn;
    date_default_timezone_set('Asia/Bangkok');
    // $timestamp = date('y-m-d h:i:s');
    $sId = htmlspecialchars($data["id"]);
    $product = htmlspecialchars($data["product"]);
    $price = htmlspecialchars($data["price"]);
    $desc = htmlspecialchars($data["desc"]);
    
    // $image = htmlspecialchars($data["image"]);
    $image = upload();
    if(!$image) {
        return false;
    }
    $query = "INSERT INTO jual
                VALUES
                (CURRENT_TIME(),'', '$product', '$image', '$price', '$desc')

    
    
    
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
    
}

function upload(){
    $namaFile = $_FILES['image']['name'];
    $ukuranFile = $_FILES['image']['size'];
    $error = $_FILES['image']['error'];
    $tmpName = $_FILES['image']['tmp_name'];
    if($error === 4){
        echo "<script> alert('Masukkan gambar!'); </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpeg', 'jpg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "<script> alert('UPLOAD GAMBAR ULANG! File yang tadi diupload bukan gambar!'); </script>";
        return false;
    }
    if($ukuranFile > 1000000){
        echo "<script>
                alert('Ukuran gambar yang disubmit terlalu besar!')
            </script>";
        return false;

    }


    //lolos pengecekan
    //generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
    return $namaFileBaru;
}

function tambahUang($data){
    global $conn;
    $topup = $data["topup"];
    $withdraw = $data["withdraw"];
    // $total = 0;
    // $total += ($topup - $withdraw);
    $totalSementara1 = mysqli_query($conn, "SELECT total FROM moneyflow ORDER BY id DESC LIMIT 1");
    $totalSementara2 = mysqli_fetch_assoc($totalSementara1);
    $totalSementara3 = $totalSementara2['total'];
    if($withdraw > $totalSementara3){
        return false;
    }
    $total = $totalSementara3 + $topup - $withdraw;
    $query = "INSERT INTO moneyflow
                VALUES
                ('','$topup', '$withdraw', '$total')

    
    
    
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
    
}

function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM jual WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function register($data){
    global $conn;

    $sId = $data["sId"];
    $password = mysqli_real_escape_string($conn, $data["password1"]); // fungsi ini untuk membuat user dapat menginputkna tanda "
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek konfirmmasi password
    if($sId < 10000 || $sId > 99999){
        echo "<script>
            alert('Student ID yang anda masukkan tak sesuai dengan persyaratan!');
        </script>";
        return false;
    }
    $sIdstring = (string)$sId;

    $duaDigit = $sIdstring[3]*10 + $sIdstring[4];
    $jumlah3Digit = $sIdstring[0] + $sIdstring[1] + $sIdstring[2];
    if($duaDigit != $jumlah3Digit){
        echo "<script>
        alert('Student ID yang anda masukkan tak sesuai dengan persyaratan!');
    </script>";
        return false;
    }

    //CEK APAKAH id sudah pernah dipakai atau belum

    $cariId = mysqli_query($conn, "SELECT sId from users WHERE sId = '$sId'");

    if($password !== $password2){
        echo " <script>
            alert('Konfirmasi password tidak sesuai dengan password yang anda masukkan!');
        </script>     
        ";
        return false;
    }
    if(mysqli_fetch_assoc($cariId)){
        echo "<script>
            alert('Student id sudah terdaftar!');
        </script>;
        
        ";
        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    //var_dump($password);
    mysqli_query($conn, "INSERT INTO users VALUES('', '$sId', '$password')");

    return mysqli_affected_rows($conn);

    

 
}


?>