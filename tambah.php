<?php
    //buat koneksi
    $connect = mysqli_connect("localhost","root","","Mahasiswa");

    //cek apakah button submit sudah ditekan apa belum
    if(isset($_POST['submit'])){
        //ambil data dari tiap element dalam form yang disimpan di variabel baru
        $nama = $_POST["Nama"];
        $nim = $_POST["Nim"];
        $email = $_POST["Email"];
        $jurusan = $_POST["Jurusan"];
        $gambar = $_POST["Gambar"];

        //query insert data
        $query = "INSERT INTO mahasiswa VALUES
        ('','$nama','$nim','$email','$jurusan','$gambar')";
        mysqli_query($connect,$query);

        //cek sukses data ditambah menggunakan mysqli_affected_rows
        //jika var_dump maka akan muncul int(1) jika gagal akan muncul int(-1)
        //var_dump(mysqli_affected_rows($connect));
        if(mysqli_affected_rows($connect) > 0){
            echo "Data Berhasil Disimpan";
        }else{
            echo "Gagal";
            echo "<br>";
            echo mysqli_error($connect);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Data</title>



    <link rel="stylesheet" type="text/css" href="../Pertemuan_11_Bootstrap/css/bootstrap.css">
    <script type="text/javascript" src="../Pertemuan_11_Bootstrap/js/jquery.js"></script>
    <script type="text/javascript" src="../Pertemuan_11_Bootstrap/js/bootstrap.js"></script>

    <style>
        body{
            background-color:magenta;
        }
        table{
            color:gold;
        }
        legend{
            color:white;
        }
        label{
            color:black;
        }
    </style>

</head>
<body>

    <nav class="navbar navbar-default navbar-static-top" role="navigation">
        <a class="navbar-brand" href="index.php">Data Mahasiswa</a>
        <a class="navbar-brand" href="tambah_data.php">tambah_data.php</a>
        <a class="navbar-brand" href="registrasi.php">registrasi.php</a>
    </nav>

    <center>
       <legend>
            <h1>Tambah Data Mahasiswa</h1>
        </legend>
    <center>
    <form class="form-horizontal" method="POST" role="form" enctype="multipart/form-data">
            
            <div class="form-group">
                <label for="" class="col-sm-4 control-label">Nama</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="Nama" id="Nama" placeholder="Nama Lengkap" required>
                </div>
            </div>


            <div class="form-group">
                <label for="" class="col-sm-4 control-label">NIM</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="Nim" id="Nim" placeholder="NIM" required>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-4 control-label">Email</label>
                <div class="col-sm-5">
                    <input type="email" class="form-control" id="Email" name="Email" placeholder="Enter email" required>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-4 control-label">Jurusan</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="Jurusan" name="Jurusan" placeholder="Jurusan" required>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-4 control-label">Gambar</label>
                <div class="col-sm-5">
                    <input type="file" class="form-control" id="Gambar" name="Gambar" placeholder="Gambar" required>
                </div>
                <div class="col-sm-1">
                    <button type="submit" class="btn btn-primary" name="submit">Tambah</button>
                </div>
            </div>
</body>
</html>