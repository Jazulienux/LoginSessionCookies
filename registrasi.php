<?php
    require 'functions.php';

    if(isset($_POST['register'])){
        if(registrasi($_POST)>0){
            echo"
                <style>
                    alert('User Berhasil Ditambah');
                </style>
            ";
        }
        else{
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
    <title>Form Registrasi</title>

    <link rel="stylesheet" type="text/css" href="../Pertemuan_11_Bootstrap/css/bootstrap.css">
    <script type="text/javascript" src="../Pertemuan_11_Bootstrap/js/jquery.js"></script>
    <script type="text/javascript" src="../Pertemuan_11_Bootstrap/js/bootstrap.js"></script>
</head>
    <style>
        label{
            display:block;
        }
        body{
            background-color:blue;
        }
        table{
            color:gold;
        }
        legend{
            color:white;
        }
        label{
            color:white;
        }
    </style>
<body>

    <nav class="navbar navbar-default navbar-static-top" role="navigation">
        <a class="navbar-brand" href="index.php">Data Mahasiswa</a>
        <a class="navbar-brand" href="tambah_data.php">tambah_data.php</a>
        <a class="navbar-brand" href="tambah.php">tambah.php</a>
    </nav>
    
    <center>
       <legend>
            <h1>Registrasi Data Mahasiswa</h1>
        </legend>
    <center>
    <form class="form-horizontal" method="POST" role="form">
            
            <div class="form-group">
                <label for="" class="col-sm-4 control-label">Username</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                </div>
            </div>


            <div class="form-group">
                <label for="" class="col-sm-4 control-label">Password</label>
                <div class="col-sm-5">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-4 control-label">Konfirmasi Password</label>
                <div class="col-sm-5">
                    <input type="password" class="form-control" id="password_konf" name="password_konf" placeholder="Password Konfirmasi" required>
                </div>
                <div class="col-sm-1">
                    <button type="submit" class="btn btn-primary" name="register">Registrasi</button>
                </div>
            </div>
</body>
</html>