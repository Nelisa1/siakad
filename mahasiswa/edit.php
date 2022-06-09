<?php include_once('../_header.php'); ?>

    <div class="box">
        <h1>Mahasiswa</h1>
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
                $sql_mhs = mysqli_query($con, "SELECT * FROM tb_mhs WHERE id_mhs = '$id'") or die (mysqli_error($con));
                $data = mysqli_fetch_array($sql_mhs);
                ?>
                <form action="proses.php" method="post">

                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="hidden" name="id" value="<?=$data['id_mhs']?>">
                        <input type="number" name="nim" id="nim" class="form-control" value="<?=$data['nim']?>" required>
                    </div>

                    <div class="form-group">
                        <label for="namamhs">Nama Mahasiswa</label>
                        <input type="text" name="namamhs" id="namamhs" class="form-control" onkeyup="this.value = this.value.toUpperCase()" value="<?=$data['namamhs']?>" required>
                    </div>

                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <div>
                            <label class="radio-inline">
                                <input type="radio" name="jk" id="jk" value="L" required <?=$data['jenkel'] == "L" ? "checked" : null ?>> Laki-laki
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="jk" value="P" <?=$data['jenkel'] == "P" ? "checked" : null ?>> Perempuan
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tmasuk">Tahun Masuk</label>
                        <input type='text' name="tmasuk" id="tmasuk" class="form-control" value="<?=$data['tmasuk']?>" required>
                    </div>

                    <div class="form-group">
                        <label for="telp">No. Telepon</label>
                        <input type="text" name="telp" id="telp" class="form-control" value="<?=$data['no_telp']?>" required>
                    </div>

                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <select name="jurusan" id="jurusan" class="form-control" value="<?=$data['jurusan']?>" required>
                            <option value="">- Pilih -</option>
                            <?php
                            $sql_jurusan = mysqli_query($con, "SELECT * FROM tb_jurusan") or die (mysqli_error($con));
                            while($datajurusan = mysqli_fetch_array($sql_jurusan)) {
                                echo '<option value="'.$datajurusan['jurusan'].'">'.$datajurusan['jurusan'].'</option>';
                            } ?>
                        </select>
                    </div>


                    <div class="form-group pull-right">
                        <input type="submit" name="edit" value="Simpan" class="btn btn-success">
                    </div>

                </form>
            </div>
        </div>
    </div>

<?php include_once('../_footer.php'); ?>