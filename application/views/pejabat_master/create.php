<!-- application/views/pejabat/create.php -->
<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('_partials/head.php') ?>
    <title>Tambah Pejabat</title>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body>
	<div class="side_nav">
		<?php $this->load->view('_partials/side_nav.php') ?>
	</div>
	<!-- Page Wrapper -->
    <div id="wrapper">
		<div id="page-wrapper">
            <div class="row">
				<div class="panel panel-default col-lg-6">
					<div class="panel-body">
						<div class="card shadow mb-4" > <br>
							<div style="text-align: left; padding: 10px; height: 350px;">
								<div class="card-header py-3">
									<h1 class="m-0 font-weight-bold text-primary">Tambah Data Pejabat</h1>
								</div>
								<form method="post" action="<?php echo base_url('pejabat/create'); ?>">
								<label>Nama:</label>
								<input type="text" class="custom-textbox" name="nama" required><br>
				
								<label>Jenis Kelamin:</label>
								<select name="jenis_kelamin" required>
								<option value="">Pilih Jenis Kelamin</option>
									<option value="L">Laki-laki</option>
									<option value="P">Perempuan</option>
								</select><br>
								
								<label>Alamat:</label>
								<textarea name="alamat" ></textarea><br>
								
								<label for="m_pejabat_id">Jabatan:</label>
								<select id="pejabatSelect" class="js-example-basic-single form-control" name= "m_pejabat_id">
								<option value="">Pilih Nama Pejabat</option>
								<?php foreach ($pejabat_options as $pejabat) : ?>
									<option value="<?php echo $pejabat->id; ?>"><?php echo $pejabat->nama; ?></option>
								<?php endforeach; ?>
								</select><br>
								<br>
								<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
								<a href="<?php echo base_url('pejabat/index'); ?>" class="btn btn-danger btn-sm">Kembali</a>
								</form>
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

    <script src="<?php echo base_url('vendor/select2/dist/js/select2.min.js'); ?>"></script>

	<script>
		$(document).ready(function() {
			$('.js-example-basic-single').select2();
		});
	</script>

	<script>
        $(document).ready(function() {
            $('#pejabatSelect').select2({
                    ajax: {
                        url: '<?= site_url('pejabat/search_pejabat') ?>',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                q: params.term,
                                page: params.page || 1
                            };
                        },
                        processResults: function(data, params) {
                            params.page = params.page || 1;

                            return {
                                results: data.results,
                                pagination: {                    
                                more: data.pagination.more
                                }
                            };
                        },
                        cache: true
                    },
                    minimumInputLength: 0
                });
        });
    </script>

</body>
<?php $this->load->view('_partials/footer.php') ?>
</html>

