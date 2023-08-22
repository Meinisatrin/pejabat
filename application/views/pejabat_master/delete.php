<!-- application/views/pejabat/delete.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Hapus Pejabat</title>
</head>
<body>
    <h1>Konfirmasi Penghapusan Pejabat</h1>
    <p>Anda yakin ingin menghapus pejabat dengan nama '<?php echo $pejabat->nama; ?>'?</p>
    <form method="post" action="<?php echo base_url('pejabat/delete/'.$pejabat->id); ?>">
        <button type="submit">Hapus</button>
        <a href="<?php echo base_url('pejabat'); ?>">Batal</a>
    </form>
</body>
</html>
