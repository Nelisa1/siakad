<?php
require_once "../_config/config.php";
require "../_assets/libs/vendor/autoload.php";

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

if(isset($_POST['add'])) {
    $uuid = Uuid::uuid4()->toString();
    $kodejur = trim(mysqli_real_escape_string($con, $_POST['kodejur']));
    $jurusan = trim(mysqli_real_escape_string($con, $_POST['jurusan']));
    $sql_cek_jurusan = mysqli_query($con, "SELECT * FROM tb_jurusan WHERE kodejur = '$kodejur'") or die (mysqli_error($con));
    if(mysqli_num_rows($sql_cek_jurusan) > 0) {
        echo "<script>alert('Kode Jurusan sudah pernah diinput!'); window.location='add.php';</script>";
    } else {
        mysqli_query($con, "INSERT INTO tb_jurusan (id_jur, kodejur, jurusan) 
                            VALUES ('$uuid', '$kodejur', '$jurusan')") or die (mysqli_error($con));
        echo "<script>window.location='data.php';</script>";
    }
} else if(isset($_POST['edit'])) {
    $id = $_POST['id'];
    $kodejur = trim(mysqli_real_escape_string($con, $_POST['kodejur']));
    $jurusan = trim(mysqli_real_escape_string($con, $_POST['jurusan']));
    $sql_cek_jurusan = mysqli_query($con, "SELECT * FROM tb_jurusan 
                                            WHERE kodejur = '$kodejur'
                                            AND id_jur != '$id'") or die (mysqli_error($con));
    if(mysqli_num_rows($sql_cek_jurusan) > 0) {
        echo "<script>alert('Kode Jurusan sudah pernah diinput!'); window.location='edit.php?id=$id';</script>";
    } else {
        mysqli_query($con, "UPDATE tb_jurusan SET kodejur = '$kodejur', jurusan = '$jurusan' WHERE id_jur = '$id'") or die (mysqli_error($con));
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

    $sql = "INSERT INTO tb_jurusan (id_jur, kodejur, jurusan) VALUES";
    for ($i=3; $i <= count($all_data); $i++) { 
        $uuid = Uuid::uuid4()->toString();
        $kodejur = $all_data[$i]['A'];
        $jurusan = $all_data[$i]['B'];
        $sql .= " ('$uuid', '$kodejur', '$jurusan'),"; 
    }
    $sql = substr($sql, 0, -1);
    // echo $sql;
    mysqli_query($con, $sql) or die (mysqli_error($con));

    unlink($target_file);
    echo "<script>window.location='data.php';</script>";
}
?>