<!-- application/views/pejabat/edit.php -->
<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('_partials/head.php') ?>
    <title>Edit Pejabat</title>
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
							<h3>Edit Data Pejabat</h3>
								<form method="post" action="<?php echo base_url('pejabat/edit/'.$pejabat->id); ?>">
									<label>Nama:</label>
									<input type="text" name="nama" value="<?php echo $pejabat->nama; ?>" required><br>

									<div class="form-group">
									<label>Jenis Kelamin:</label>
									<select name="jenis_kelamin" required>
									<option value="">Pilih Jenis Kelamin</option>
										<option value="L" <?php echo ($pejabat->jenis_kelamin == 'L') ? 'selected' : ''; ?>>Laki-laki</option>
										<option value="P" <?php echo ($pejabat->jenis_kelamin == 'P') ? 'selected' : ''; ?>>Perempuan</option>
									</select><br>
									</div>

									<label>Alamat:</label>
									<input type="text" name="alamat" value="<?php echo $pejabat->alamat; ?>" required><br>

									<label for="m_pejabat_id">Jabatan:</label>
									<select id="pejabatSelect" class="js-example-basic-single form-control" name="m_pejabat_id">
										<?php foreach ($pejabat_options as $master_pejabat): ?>
											<option value="<?= $master_pejabat->id ?>" <?= ($master_pejabat->id == $pejabat->m_pejabat_id) ? 'selected' : '' ?>>
												<?= $master_pejabat->nama ?>
											</option>
										<?php endforeach; ?>
									</select> </br>
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
</script>
</body>
<?php $this->load->view('_partials/footer.php') ?>
</html>
