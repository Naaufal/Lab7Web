<?= $this->include('template/admin_header'); ?>
<h2><?= $title; ?></h2>
<form action="" method="post">
    <p>
        <input type="text" name="judul" placeholder="Masukkan Judul disini">
    </p>
    <p>
        <textarea name="isi" cols="50" rows="10" placeholder="Masukkan Isi artikel disini"></textarea>
    </p>
    <p>
        <input type="submit" value="Kirim" class="btn btn-large">
    </p>
</form>
<?= $this->include('template/admin_footer'); ?>