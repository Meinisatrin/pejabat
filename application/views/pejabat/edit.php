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
						<div class="card shadow mb-4" >
								<h3>Edit Data Master Pejabat</h3>
									<form method="post" action="<?php echo base_url('master_pejabat/edit/'.$pejabat->id); ?>">
										<div class="form-group">	
											<label>Nama:</label>
											<input type="text" class="custom-textbox" name="nama" value="<?php echo $pejabat->nama; ?>" required> <br>
										</div>	
										<br>
									<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
									<a href="<?php echo base_url('master_pejabat/index'); ?>" class="btn btn-danger btn-sm">Kembali</a>
									</form>
								</div>
							</div>
						</div>
					</div>					
				</div>
			</div>		
		</div>
    </div>
</body>
<?php $this->load->view('_partials/footer.php') ?>
</html>
