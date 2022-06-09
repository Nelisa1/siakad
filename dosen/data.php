<?php include_once('../_header.php'); ?>

    <div class="box">
        <h1>Dosen</h1>
        <h4>
            <small>Data Dosen</small>
            <div class="pull-right">
                <a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
                <a href="add.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i>Tambah Data</a> 
            </div>
        </h4>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dosen">
                <thead>
                    <tr>
                        <th>NIP</th>
                        <th>Nama Dosen</th>
                        <th>JenKel</th>
                        <th>Gol</th>
                        <th>Alamat</th>
                        <th>No. Telepon</th>
                        <th>Jurusan</th>
                        <th><i class="glyphicon glyphicon-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM tb_dosen
                            INNER JOIN tb_jurusan ON tb_dosen.jurusan = tb_jurusan.jurusan";?>
                </tbody>
            </table>
        </div>
        <script>
        $(document).ready(function() {
            $('#dosen').DataTable( {
                "processing": true,
                "serverSide": true,
                "ajax": "dosen_data.php",
                scrollY : '250px',
                dom : 'Bfrtip',
                buttons : [
                    {
                        extend : 'pdf',
                        orientation : 'potrait',
                        pageSize : 'Legal',
                        title : 'Data Dosen',
                        download : 'open'
                    },
                    'csv', 'excel', 'print', 'copy'
                ],
                columnDefs : [
                    {
                        "searchable" : false,
                        "orderable" : false,
                        "targets": 7,
                        "render" : function(data, type, row) {
                            var btn = "<center><a href=\"edit.php?id="+data+"\" class=\"btn btn-warning btn-xs\"><i class=\"glyphicon glyphicon-edit\"></i></a> <a href=\"del.php?id="+data+"\" onclick=\"return confirm('Yakin menghapus data?')\" class=\"btn btn-danger btn-xs\"><i class=\"glyphicon glyphicon-trash\"></i></a></center>";
                            return btn;
                        }
                    }
                ]
            } );
        } );
        </script>
    </div>

<?php include_once('../_footer.php'); ?>