<?php include_once('../_header.php'); ?>

    <div class="box">
        <h1>Dosen</h1>
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
                        <label for="nip">NIP</label>
                        <input type="text" name="nip" id="nip" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="namadsn">Nama Dosen</label>
                        <input type="text" name="namadsn" id="namadsn" class="form-control" onkeyup="this.value = this.value.toUpperCase()" required>
                    </div>

                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <div>
                            <label class="radio-inline">
                                <input type="radio" name="jk" id="jk" value="L" required> Laki-laki
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="jk" value="P"> Perempuan
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="gol">Gol</label>
                        <input type="text" name="gol" id="gol" class="form-control" onkeyup="this.value = this.value.toUpperCase()" required>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="telp">No. Telepon</label>
                        <input type="text" name="telp" id="telp" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <select name="jurusan" id="jurusan" class="form-control" required>
                            <option value="">- Pilih -</option>
                            <?php
                            $sql_jurusan = mysqli_query($con, "SELECT * FROM tb_jurusan") or die (mysqli_error($con));
                            while($datajurusan = mysqli_fetch_array($sql_jurusan)) {
                                echo '<option value="'.$datajurusan['jurusan'].'">'.$datajurusan['jurusan'].'</option>';
                            } ?>
                        </select>
                    </div>

                    <div class="form-group pull-right">
                        <input type="submit" name="add" value="Simpan" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php include_once('../_footer.php'); ?>