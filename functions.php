<?php
//membuat koneksi
$connect = mysqli_connect ("localhost","root","","Mahasiswa");
//ambil data dari tabel mahasiswa / query data mahasiswa
$result = mysqli_query ($connect, "SELECT * FROM mahasiswa");

// while($mhs = mysqli_fetch_assoc ($result)){
//     var_dump($mhs);
// }

function query($query_kedua){
    global $connect;

    $result = mysqli_query($connect,$query_kedua);

    $rows= [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data){
    global $connect;

    
    $nama = htmlspecialchars($data["Nama"]);
    $nim = htmlspecialchars($data["Nim"]);
    $email = htmlspecialchars($data["Email"]);
    $jurusan = htmlspecialchars($data["Jurusan"]);

    $gambar = upload();
    if(!$gambar){
        return false;
    }

    $query = "INSERT INTO mahasiswa VALUES
    ('','$nama','$nim','$email','$jurusan','$gambar')";
    mysqli_query($connect,$query);

    return mysqli_affected_rows($connect);
}

function hapus($id){
    global $connect;
    mysqli_query($connect,"DELETE FROM mahasiswa WHERE id=$id");
    return mysqli_affected_rows($connect);
}

function edit($data){
    global $connect;
    
    $id = $data["id"];
    
    $nama = htmlspecialchars($data["Nama"]);
    $nim = htmlspecialchars($data["Nim"]);
    $email = htmlspecialchars($data["Email"]);
    $jurusan = htmlspecialchars($data["Jurusan"]);
    $GambarLama = htmlspecialchars($data["GambarLama"]);

    //cek apakah user menekan tombol browse
    if($_FILES["Gambar"]['error']===4){
        $gambar = $GambarLama;
    }
    else{
        $gambar = upload();
    }

    $query = "UPDATE mahasiswa SET
              Nama = '$nama',
              Email = '$email',
              Jurusan = '$jurusan',
              Gambar = '$gambar'
              WHERE id = $id";
    mysqli_query($connect,$query);

    return mysqli_affected_rows($connect);
}

function cari($keyword){
    $sql = "SELECT * FROM mahasiswa
    WHERE 
    Nama LIKE '%$keyword%' OR
    Nim LIKE '%$keyword%' OR
    Email LIKE '%$keyword%' OR
    Jurusan LIKE '%$keyword%'"
    ;
    return query($sql);
}

function upload(){
    $nama_file = $_FILES["Gambar"]["name"];
    $ukuran_file = $_FILES["Gambar"]["size"];
    $error = $_FILES["Gambar"]["error"];
    $tmp_file = $_FILES["Gambar"]["tmp_name"];

    if($error===4){
        //pastikan pada atribut gambar tidak ada atribut required
        echo"
            <script>
                alert('Tidak Ada Gambar yang diupload');
            </script>
        ";
        return false;
    }
    $jenis_gambar = ['jpg','jpeg','gif'];
    $pecah_gambar = explode('.',$nama_file);
    $pecah_gambar = strtolower(end($pecah_gambar));

    if(!in_array($pecah_gambar,$jenis_gambar)){
        echo"
            <script>
                alert('Yang anda upload bukan file gambar');
            </script>
        ";
        return false;
    }

    //cek ukuran gambar
    if($ukuran_file > 1000000){
        echo"
        <script>
            alert('Ukuran gambar terlalu besar');
        </script>
        ";
        return false; 
    }

    $nama_filebaru = uniqid();
    $nama_filebaru .='.';
    $nama_filebaru .= $pecah_gambar;

    move_uploaded_file($tmp_file,'image/'.$nama_filebaru);

    return $nama_filebaru;
}

function registrasi($data){
    global $connect;

    //stripcslashes untuk menghilangkan blackslash
    $username = strtolower(stripcslashes($data['username']));

    //mysqli_real_escape_string untuk memberikan perlindungan terhadap karakter karakter unik(sql_injection)
    //ada 2 parameter
    $password = mysqli_real_escape_string($connect,$data['password']);
    $password_konf = mysqli_real_escape_string($connect,$data['password_konf']);

    //cek username sudah ada apa belum
    $result = mysqli_query($connect,"SELECT username FROM user WHERE  username='$username'");

    //cek kondisi jika line 105 bernilai true maka cetak echo
    if(mysqli_fetch_assoc($result)){
        echo "
            <script>
                alert('Username Sudah Ada');
            </script>
        ";
        return false;
    }

    //cek konf password
    if($password !== $password_konf){
        echo "
            <script>
                alert('Password anda tidak sama');
            </script>
        ";
        return false;
    }

    //enkripsi
    $password=md5($password);
    var_dump($password);
    //$password = password_hash($passwordm,PASSWORD_DEFAULT);

    mysqli_query($connect,"INSERT INTO user VALUES('','$username','$password')");

    return mysqli_affected_rows($connect);
}
?>
