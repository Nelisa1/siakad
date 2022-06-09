<?php
require_once "../_config/config.php";
require "../_assets/libs/vendor/autoload.php";

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

if(isset($_POST['add'])) {
    $uuid = Uuid::uuid4()->toString();
    $nim = trim(mysqli_real_escape_string($con, $_POST['nim']));
    $namamhs = trim(mysqli_real_escape_string($con, $_POST['namamhs']));
    $jk = trim(mysqli_real_escape_string($con, $_POST['jk']));
    $tmasuk = trim(mysqli_real_escape_string($con, $_POST['tmasuk']));
    $telp = trim(mysqli_real_escape_string($con, $_POST['telp']));
    $jurusan = trim(mysqli_real_escape_string($con, $_POST['jurusan']));
    $sql_cek_nim = mysqli_query($con, "SELECT * FROM tb_mhs WHERE nim = '$nim'") or die (mysqli_error($con));
    if(mysqli_num_rows($sql_cek_nim) > 0) {
        echo "<script>alert('Nomor nim sudah pernah diinput!'); window.location='add.php';</script>";
    } else {
        mysqli_query($con, "INSERT INTO tb_mhs (id_mhs, nim, namamhs, jenkel, tmasuk, no_telp, jurusan) 
                            VALUES ('$uuid', '$nim', '$namamhs', '$jk', '$tmasuk', '$telp', '$jurusan')") or die (mysqli_error($con));
        echo "<script>window.location='data.php';</script>";
    }
} else if(isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nim = trim(mysqli_real_escape_string($con, $_POST['nim']));
    $namamhs = trim(mysqli_real_escape_string($con, $_POST['namamhs']));
    $jk = trim(mysqli_real_escape_string($con, $_POST['jk']));
    $tmasuk = trim(mysqli_real_escape_string($con, $_POST['tmasuk']));
    $telp = trim(mysqli_real_escape_string($con, $_POST['telp']));
    $jurusan = trim(mysqli_real_escape_string($con, $_POST['jurusan']));
    $sql_cek_nim = mysqli_query($con, "SELECT * FROM tb_mhs 
                                            WHERE nim = '$nim'
                                            AND id_mhs != '$id'") or die (mysqli_error($con));
    if(mysqli_num_rows($sql_cek_nim) > 0) {
        echo "<script>alert('Nomor nim sudah pernah diinput!'); window.location='edit.php?id=$id';</script>";
    } else {
        mysqli_query($con, "UPDATE tb_mhs SET nim = '$nim', 
                            namamhs = '$namamhs', jenkel = '$jk', tmasuk = '$tmasuk',
                            no_telp = '$telp', jurusan = '$jurusan' WHERE id_mhs = '$id'") or die (mysqli_error($con));
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

    $sql = "INSERT INTO tb_mhs (id_mhs, nim, namamhs, jenkel, tmasuk, no_telp, jurusan) VALUES";
    for ($i=3; $i <= count($all_data); $i++) { 
        $uuid = Uuid::uuid4()->toString();
        $nim = $all_data[$i]['A'];
        $namamhs = $all_data[$i]['B'];
        $jk = $all_data[$i]['C'];
        $tmasuk = $all_data[$i]['D'];
        $telp = $all_data[$i]['E'];
        $jurusan = $all_data[$i]['F'];
        $sql .= " ('$uuid', '$nim', '$namamhs', '$jk', '$tmasuk', '$telp', '$jurusan'),"; 
    }
    $sql = substr($sql, 0, -1);
    // echo $sql;
    mysqli_query($con, $sql) or die (mysqli_error($con));

    unlink($target_file);
    echo "<script>window.location='data.php';</script>";
}
?>