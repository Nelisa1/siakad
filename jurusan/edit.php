<?php include_once('../_header.php'); ?>

    <div class="box">
        <h1>Jurusan</h1>
        <h4>
            <small>Edit Data</small>
            <div class="pull-right">
                <a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
            </div>
        </h4>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <?php
                $id = @$_GET['id'];
                $sql_jurusan = mysqli_query($con, "SELECT * FROM tb_jurusan WHERE id_jur = '$id'") or die (mysqli_error($con));
                $data = mysqli_fetch_array($sql_jurusan);
                ?>
                <form action="proses.php" method="post">

                    <div class="form-group">
                        <label for="kodejur">Kode Jurusan</label>
                        <input type="hidden" name="id" value="<?=$data['id_jur']?>">
                        <input type="text" name="kodejur" id="kodejur" class="form-control" value="<?=$data['kodejur']?>" required>
                    </div>

                    <div class="form-group">
                        <label for="jurusan">Nama Dosen</label>
                        <input type="text" name="jurusan" id="jurusan" class="form-control" value="<?=$data['jurusan']?>" required>
                    </div>
                    
                    <div class="form-group pull-right">
                        <input type="submit" name="edit" value="Simpan" class="btn btn-success">
                    </div>

                </form>
            </div>
        </div>
    </div>

<?php include_once('../_footer.php'); ?>