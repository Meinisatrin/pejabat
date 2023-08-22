<!-- application/views/pejabat/index.php -->
<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('_partials/head.php') ?>
    <title>Master Pejabat</title>
	<!-- CSS DataTables -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/datatables.min.css') ?>">
</head>
    
<body>   
	<div class="side_nav">
		<?php $this->load->view('_partials/side_nav.php') ?>
	</div>
	<!-- Page Wrapper -->
    <div id="wrapper">
		<div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
						<!-- Main Content -->
						<div id="content">
							<!-- Begin Page Content -->
							<div class="container-fluid">
								<div class="card shadow mb-4"> <br>
									<div style="text-align: right; padding: 10px;">
										<a href="<?php echo base_url('master_pejabat/create'); ?>" style="background-color: #007bff; color: #fff; padding: 7px 10px; border: none; border-radius: 5px; cursor: pointer;">Tambah Data</></a> <br>
									</div>
									<br>
								<div class="card-header py-3">
									<h1 class="m-0 font-weight-bold text-primary">Data Master Pejabat</h1>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-bordered" id="master" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th>No</th>
													<th>ID</th>
													<th>Nama</th>
													<th>Tanggal Buat</th>
													<th>Tanggal Ubah</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody>
												</tbody>
											</table>
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
		// $(document).ready(function() {
		// 	$('#dataTables-example').DataTable({
		// 		responsive: true
		// 	});
		// });

		var table = $('#dataTables-example').DataTable({
			debug: true
		});
		table.destroy();
		// Sekarang Anda dapat memanggil .DataTable() kembali tanpa masalah

		</script>

		<script>
		$(document).ready(function() {
    	$('#master').DataTable({
        "processing": true,
        "serverSide": true,

        "ajax": {
            "url": "<?php echo base_url('master_pejabat/get_data'); ?>",
            "type": "POST"
        },
		"columns": [

		{"data": null,width: 30}, 
		{"data": "id",width:30},
		{"data": "nama",width:200},
		{"data": "tglBuat",width:150},
		{"data": "tglUbah",width:150},
		{
			"data": null,
			"width": 100,
			"orderable": false,
			"render": function(data, type, row) {
				var editUrl = "<?php echo site_url('master_pejabat/edit'); ?>/" + row.id;
				var deleteUrl = "<?php echo site_url('master_pejabat/delete'); ?>/" + row.id;

				return '<a href="' + editUrl + '" class="btn btn-primary btn-sm">Edit</a>' +
						' ' +
					'<a href="' + deleteUrl + '" class="btn btn-danger btn-sm" onclick="return confirmDelete()">Delete</a>';

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
