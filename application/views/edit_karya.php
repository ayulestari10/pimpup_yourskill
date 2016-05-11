<div class="container" style="margin-top: 4%;">
	<?php foreach ($data_karya as $row): ?>
		<?= form_open('index.php/site/update') ?>
			<input type="hidden" name="id_karya" value="<?= $row->id_karya ?>" />
			<div class="form-group">
				<label for="nama" style="color: white;">Nama</label>
				<input class="form-control" type="text" name="nama" value="<?= $row->nama ?>" />
			</div>
			<div class="form-group">
				<label for="jurusan" style="color: white;">Jurusan</label>
				<input class="form-control" type="text" name="jurusan" value="<?= $row->jurusan ?>" />
			</div>
			<div class="form-group">
				<label for="nama_karya" style="color: white;">Nama Karya</label>
				<input class="form-control" type="text" name="nama_karya" value="<?= $row->nama_karya ?>" />
			</div>
			<div class="form-group">
				<label for="kategori_karya" style="color: white;">Kategori Karya</label>
				<input class="form-control" type="text" name="kategori_karya" value="<?= $row->kategori_karya ?>" />
			</div>
			<div class="form-group">
				<label for="jenis_karya" style="color: white;">Jenis Karya</label>
				<input class="form-control" type="text" name="jenis_karya" value="<?= $row->jenis_karya ?>" />
			</div>
			<div class="form-group">
				<label for="detail_karya" style="color: white;">Detail Karya</label>
				<textarea name="detail_karya" class="form-control" rows="15" ><?php echo $row->detail_karya; ?></textarea>
			</div>
			<input type="submit" class="btn btn-success" value="Update" />
		<?= form_close() ?>
	<?php endforeach; ?>
</div>