<?php
require_once "../_config/config.php";
require "../_assets/libs/vendor/autoload.php";

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

if(isset($_POST['add'])) {
    $uuid = Uuid::uuid4()->toString();
    $nip = trim(mysqli_real_escape_string($con, $_POST['nip']));
    $namadsn = trim(mysqli_real_escape_string($con, $_POST['namadsn']));
    $jk = trim(mysqli_real_escape_string($con, $_POST['jk']));
    $gol = trim(mysqli_real_escape_string($con, $_POST['gol']));
    $alamat = trim(mysqli_real_escape_string($con, $_POST['alamat']));
    $telp = trim(mysqli_real_escape_string($con, $_POST['telp']));
    $jurusan = trim(mysqli_real_escape_string($con, $_POST['jurusan']));
    $sql_cek_nip = mysqli_query($con, "SELECT * FROM tb_dosen WHERE nip = '$nip'") or die (mysqli_error($con));
    if(mysqli_num_rows($sql_cek_nip) > 0) {
        echo "<script>alert('Nomor nip sudah pernah diinput!'); window.location='add.php';</script>";
    } else {
        mysqli_query($con, "INSERT INTO tb_dosen (id_dosen, nip, namadsn, jenkel, gol, alamat, no_telp, jurusan) 
                            VALUES ('$uuid', '$nip', '$namadsn', '$jk', '$gol', '$alamat', '$telp', '$jurusan')") or die (mysqli_error($con));
        echo "<script>window.location='data.php';</script>";
    }
} else if(isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nip = trim(mysqli_real_escape_string($con, $_POST['nip']));
    $namadsn = trim(mysqli_real_escape_string($con, $_POST['namadsn']));
    $jk = trim(mysqli_real_escape_string($con, $_POST['jk']));
    $gol = trim(mysqli_real_escape_string($con, $_POST['gol']));
    $alamat = trim(mysqli_real_escape_string($con, $_POST['alamat']));
    $telp = trim(mysqli_real_escape_string($con, $_POST['telp']));
    $jurusan = trim(mysqli_real_escape_string($con, $_POST['jurusan']));
    $sql_cek_nip = mysqli_query($con, "SELECT * FROM tb_dosen 
                                            WHERE nip = '$nip'
                                            AND id_dosen != '$id'") or die (mysqli_error($con));
    if(mysqli_num_rows($sql_cek_nip) > 0) {
        echo "<script>alert('Nomor nip sudah pernah diinput!'); window.location='edit.php?id=$id';</script>";
    } else {
        mysqli_query($con, "UPDATE tb_dosen SET nip = '$nip', 
                            namadsn = '$namadsn', jenkel = '$jk', alamat = '$alamat',
                            no_telp = '$telp', jurusan = '$jurusan' WHERE id_dosen = '$id'") or die (mysqli_error($con));
        echo "<script>window.location='data.php';</script>";
    }
} else if(isset($_POST['import'])) {
    $file = $_FILES['file']['name'];
    $ekstensi = explode(".", $file);
    $file_name = "file-".round(microtime(true)).".".end($ekstensi);
    $sumber = $_FILES['file']['tmp_name'];
    $target_dir = "../_file/";
    $target_file = $target_dir.$file_name;
    move_uploaded_file($sumber, $target_file);
    
    $obj = PHPExcel_IOFactory::load($target_file);
    $all_data = $obj->getActiveSheet()->toArray(null, true, true, true);

    $sql = "INSERT INTO tb_dosen (id_dosen, nip, namadsn, jenkel, gol, alamat, no_telp, jurusan) VALUES";
    for ($i=3; $i <= count($all_data); $i++) { 
        $uuid = Uuid::uuid4()->toString();
        $nip = $all_data[$i]['A'];
        $namadsn = $all_data[$i]['B'];
        $jk = $all_data[$i]['C'];
        $gol = $all_data[$i]['D'];
        $alamat = $all_data[$i]['E'];
        $telp = $all_data[$i]['F'];
        $jurusan = $all_data[$i]['G'];
        $sql .= " ('$uuid', '$nip', '$namadsn', '$jk', '$gol', '$alamat', '$telp', '$jurusan'),"; 
    }
    $sql = substr($sql, 0, -1);
    // echo $sql;
    mysqli_query($con, $sql) or die (mysqli_error($con));

    unlink($target_file);
    echo "<script>window.location='data.php';</script>";
}
?>