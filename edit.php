<?php

    require 'functions.php';
    //cek apakah button submit sudah ditekan / belum
    if(isset($_POST['submit'])){
        //cek sukses data ditambah menggunakan functions tambah pada functions.php
        if(edit($_POST) > 0){
            echo "
            <script>
                alert('data berhasil diperbaharui');
                document.location.href='index.php';
            </script>
            ";
        }
        else{
            echo "
            <script>
                alert('data gagal diperbaharui');
                document.location.href='edit.php';
                </script>
            ";
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
            background-color:orange;
        }
        table{
            color:gold;
        }
        legend{
            color:white;
        }
        label{
            color:blue;
        }
    </style>

</head>
<body>

    <nav class="navbar navbar-default navbar-static-top" role="navigation">
        <a class="navbar-brand" href="index.php">Data Mahasiswa</a>
        <a class="navbar-brand" href="tambah_data.php">tambah_data.php</a>
        <a class="navbar-brand" href="tambah.php">tambah.php</a>
        <a class="navbar-brand" href="registrasi.php">registrasi.php</a>
    </nav>

    <?php
        //menggunakan method get untuk mengambil id yang telah terseleksi oleh user dan dimasukkan ke dalam variable baru yaitu $id
        $id = $_GET["id"];
        // var_dump($id);


        //query berdasar id
        $mhs = query("SELECT * FROM mahasiswa WHERE id=$id")[0];
        // var_dump($mhs);
        //  var_dump($mhs[0]["Nama"]);
    ?>

    <center>
       <legend>
            <h1>Edit Data Mahasiswa</h1>
        </legend>
    <center>
    <form class="form-horizontal" method="POST" role="form" enctype="multipart/form-data">
            <div class="form-group">
                <div class="col-sm-5">
                    <input type="hidden" class="form-control" name="id" value="<?= $mhs["id"]; ?>" >
                    <input type="hidden" class="form-control" name="GambarLama" value="<?= $mhs["Gambar"]; ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-4 control-label">Nama</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="Nama" id="Nama" placeholder="Nama Lengkap" value="<?= $mhs["Nama"]; ?>" required >
                </div>
            </div>


            <div class="form-group">
                <label for="" class="col-sm-4 control-label">NIM</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="Nim" id="Nim" placeholder="NIM" value="<?= $mhs["Nim"]; ?>"required>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-4 control-label">Email</label>
                <div class="col-sm-5">
                    <input type="email" class="form-control" id="Email" name="Email" placeholder="Enter email" value="<?= $mhs["Email"]; ?>"required>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-4 control-label">Jurusan</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="Jurusan" name="Jurusan" placeholder="Jurusan" value="<?= $mhs["Jurusan"]; ?>"required>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-4 control-label">Gambar</label>
                <div class="col-sm-5">
                    <img src="image/<?= $mhs["Gambar"];?>" alt="" height="100" width="100">
                    <input type="file" class="form-control" id="Gambar" name="Gambar">
                </div>
                <div class="col-sm-1">
                    <button type="submit" class="btn btn-primary" name="submit">Update</button>
                </div>
            </div>
</body>
</html>