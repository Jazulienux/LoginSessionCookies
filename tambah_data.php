<?php
    
    session_start();
    
    if(!isset($_SESSION["login"])){
        echo $_SESSION["login"];
        header('Location:login.php');
        exit;
    }

    require 'functions.php';

    //cek apakah button submit sudah ditekan / belum
    if(isset($_POST['submit'])){
        //cek sukses data ditambah menggunakan functions tambah pada functions.php
        
        //cek isi dari post menggunakan vardump
        // var_dump($_POST);
        // var_dump($_FILES);
        // die();
        
        if(tambah($_POST) > 0){
            echo "
            <script>
                alert('data berhasil disimpan');
                document.location.href='index.php';
            </script>
            ";
        }
        else{
            echo "
            <script>
                alert('data gagal disimpan');
                document.location.href='tambah_data.php';
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
            background-image:url("../Pertemuan_11_Bootstrap/bcg.jpg");
        }
        table{
            color:gold;
        }
        legend{
            color:white;
        }
        label{
            color:gold;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-default navbar-static-top" role="navigation">
        <a class="navbar-brand" href="index.php">Data Mahasiswa</a>
        <a class="navbar-brand" href="tambah.php">tambah.php</a>
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
                    <input type="file" class="form-control" id="Gambar" name="Gambar" placeholder="Gambar">
                </div>
                <div class="col-sm-1">
                    <button type="submit" class="btn btn-primary" name="submit">Tambah</button>
                </div>
            </div>
</body>
</html>