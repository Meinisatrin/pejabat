<!-- application/views/pejabat/index.php -->
<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('_partials/head.php') ?>
    <title>Daftar Pejabat</title>
</head>

<body>
	<div class="side_nav">
		<?php $this->load->view('_partials/side_nav.php') ?>
	</div>
	<!-- Page Wrapper -->
	<div class="wrapper">
    <div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<!-- Content Wrapper -->
				<div id="content-wrapper" class="d-flex flex-column">
					<!-- Main Content -->
					<div id="content">
						<!-- Begin Page Content -->
						<div class="container-fluid">
							<div class="card shadow mb-4"> <br>
								<div style="text-align: right; padding: 10px;">
									<a href="<?php echo base_url('pejabat/create'); ?>" style="background-color: #007bff; color: #fff; padding: 7px 10px; border: none; border-radius: 5px; cursor: pointer;">Tambah Data</a> <br>
								</div>
								<br>
								<div class="card-header py-3">
									<h1 class="m-0 font-weight-bold text-primary">Data Pejabat</h1>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-bordered" id="dataTables-example" width="100%" cellspacing="0">
											<thead> 
												<tr>
													<th>No</th>	
													<th>ID</th>
													<th>Nama</th>
													<th>Jenis Kelamin</th>
													<th>Alamat</th>
													<th>Jabatan</th>
													<th>Tanggal Buat</th>
													<th>Tanggal Ubah</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
	
	<!-- jQuery -->
	<script src="<?php echo base_url('vendor/jquery/jquery.min.js') ?>" ></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="<?php echo base_url('vendor/bootstrap/js/bootstrap.min.js') ?>"></script>

	<!-- Metis Menu Plugin JavaScript -->
	<script src="<?php echo base_url('vendor/metisMenu/metisMenu.min.js') ?>"></script>

	<!-- Morris Charts JavaScript -->
	<script src="<?php echo base_url('vendor/raphael/raphael.min.js') ?>"></script>
	<script src="<?php echo base_url('vendor/morrisjs/morris.min.js') ?>"></script>
	<script src="<?php echo base_url('data/morris-data.js') ?>"></script>

	<!-- Custom Theme JavaScript -->
	<script src="<?php echo base_url('dist/js/sb-admin-2.js') ?>"></script>

	<!-- DataTables JavaScript -->
	<script src="<?php echo base_url('vendor/datatables/js/jquery.dataTables.min.js') ?>"></script>
	<script src="<?php echo base_url('vendor/datatables-plugins/dataTables.bootstrap.min.js') ?>"></script>
	<script src="<?php echo base_url('vendor/datatables-responsive/dataTables.responsive.js') ?>"></script>

	<script>
	var table = $('#dataTables-example').DataTable({
			debug: true
		});
		table.destroy();
		// Sekarang Anda dapat memanggil .DataTable() kembali tanpa masalah

	</script>

	<script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                "processing": true,
                "serverSide": true,

                "order": [], 
                "ajax": {
                    "url": "<?php echo site_url('pejabat/get_data'); ?>",
                    "type": "POST"
                },
                "columns": [

                    {"data": null,width: 10}, // Add row_number column
                        {"data": "id",width:10},
                        {"data": "nama",width:100},
                        {"data": "jenis_kelamin",width:10},
                        {"data": "alamat",width:100},
                        {"data": "nama_master",width:50},
                        {"data": "tglBuat",width:100},
                        {"data": "tglUbah",width:100},
                        {
                            "data": null,
                            "width": 100,
                            "orderable": false,
                            "render": function(data, type, row) {
                                var editUrl = "<?php echo site_url('pejabat/edit'); ?>/" + row.id;
                                var deleteUrl = "<?php echo site_url('pejabat/delete'); ?>/" + row.id;

                                return '<a href="' + editUrl + '" class="btn btn-primary btn-sm">Edit</a>' +
                                        ' ' +
                                       '<a href="' + deleteUrl + '" class="btn btn-danger btn-sm ml-2" onclick="return confirmDelete()">Delete</a>';

                            }
                        }
                ],
                "createdRow": function(row, data, index) {
                $('td', row).eq(0).html(index + 1);
            }
                
            });
        });
    </script>

    <script>
        function confirmDelete() {
    return confirm('Apakah Anda yakin ingin menghapus data ini?');
}
    </script>
</body>
<?php $this->load->view('_partials/footer.php') ?>
</html>
