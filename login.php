<?php
    
    session_start();

    if(isset($_COOKIE["id"]) && isset($_COOKIE["username"])){
        $id = $_COOKIE["id"];
        $key = $_COOKIE["key"];
        
        //ambil username berdasar id
        $result=mysqli_query($connect,"SELECT username FROM user WHERE id=$id");
        $row = mysqli_fetch_assoc($result);

        //cek cookie dan username
        if($key === hash('sha256',$row["username"])){
            $_SESSION["login"]=true;
        }
    }

    //cek cookie
    if(isset($_COOKIE["login"])){
        if($_COOKIE["login"] == 'true'){
            $_SESSION["login"] = true;
        }
    }

    if(isset($_SESSION["login"])){
        header('Location:index.php');
        exit;
    }

    require 'functions.php';

    if(isset($_POST["login"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $result = mysqli_query($connect,"SELECT * FROM user WHERE username = '$username'");
        $hash = password_hash($username, PASSWORD_DEFAULT);

        if(mysqli_num_rows($result)===1){
            $row = mysqli_fetch_assoc($result);

            if(password_verify($password,$hash)){

                $_SESSION["login"] = true;

                if(isset($_POST['remember'])){
                    setcookie('id',$row["id"],time()+60);
                    setcookie('key',hash(sha256,$row["username"]),time()+60);
                }
                header("Location:index.php");
                exit;
            }       
        }
        $error = true;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Login</title>


    <link rel="stylesheet" type="text/css" href="../Pertemuan_14_Bootstrap/css/bootstrap.css">
    <script type="text/javascript" src="../Pertemuan_14_Bootstrap/js/jquery.js"></script>
    <script type="text/javascript" src="../Pertemuan_14_Bootstrap/js/bootstrap.js"></script>

</head>
<body>
    <h1>Halaman Login</h1>
    <br>
    <?php if(isset($error)):?>
        <p style="color:red;font-style=bold">
        Username Dan Password Salah</p>
    <?php endif?>

    <br>

     <form class="form-horizontal" method="POST" role="form">
            <div class="form-group">
                <label for="" class="col-sm-1 control-label">Username</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-1 control-label">Password</label>
                <div class="col-sm-5">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>
                
            </div>

            <div class="form-group">
                <div class="col-sm-1">
                    <input type="checkbox" class = "col-sm-4" name="remember" id="remember">
                </div>
                <div class="col-sm-2">
                <label for="" class="col-sm- control-label">Remember For This Password</label>
                </div>

                <div class="col-sm-1">
                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                </div>
            </div>

        </form>

</body>
</html>
