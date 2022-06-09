<?php include_once('../_header.php'); ?>

    <div class="box">
        <h1>Jurusan</h1>
        <h4>
            <small>Tambah Data</small>
            <div class="pull-right">
                <a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
            </div>
        </h4>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <form action="proses.php" method="post">
                    
                    <div class="form-group">
                        <label for="kodejur">Kode Jurusan</label>
                        <input type="text" name="kodejur" id="kodejur" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="jurusan">Nama Jurusan</label>
                        <input type="text" name="jurusan" id="jurusan" class="form-control" required>
                    </div>

                    <div class="form-group pull-right">
                        <input type="submit" name="add" value="Simpan" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php include_once('../_footer.php'); ?>