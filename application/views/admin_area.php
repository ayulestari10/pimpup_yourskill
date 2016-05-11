<style type="text/css">
	table{
		margin-top: 4%;
	}
</style>

<?php 
	$db = $this->set_karya->get_db(); 
?>

<div class="container">
	<table class="table table-striped">
		<tr>
			<th style="text-align: center;">No.</th>
			<th style="text-align: center;">Nama</th>
			<th style="text-align: center;">Jurusan</th>
			<th style="text-align: center;">Nama Karya</th>
			<th style="text-align: center;">Kategori</th>
			<th style="text-align: center; width: 40px;">Jenis Karya</th>
			<th style="text-align: center;">Url Karya</th>
			<th style="text-align: center;">Detail Karya</th>
			<th style="text-align: center;"></th>
		</tr>
		<?php foreach ($db as $col): ?>
		<tr class="info">
			<td><?php echo $col->id_karya; ?></td>
			<td><?php echo $col->nama; ?></td>
			<td><?php echo $col->jurusan; ?></td>
			<td><?php echo $col->nama_karya; ?></td>
			<td><?php echo $col->kategori_karya; ?></td>
			<td><?php echo $col->jenis_karya; ?></td>
			<td><?php echo $col->url_karya; ?></td>
			<td>
				<?php 
					$detail = substr($col->detail_karya, 0, 100); 
					echo $detail.' . . .';
				?>
			</td>
			<td>
				<a class="btn btn-danger" href="<?= base_url('index.php/site/delete/'.$col->id_karya) ?>"><i class="glyphicon glyphicon-trash"></i> Delete</a>
				<a class="btn btn-primary" href="<?= base_url('index.php/site/edit/'.$col->id_karya) ?>"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>

</div>

<?php  
	
?>