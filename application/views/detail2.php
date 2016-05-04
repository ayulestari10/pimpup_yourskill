<style type="text/css">
	*{
		color: black;
	}	
</style>

<?php  
	$db = $url;

	foreach ($db->result() as $col_db) {
?>

<div class="row" style="margin-top: 6%" id="detail">
	<div class="col-md-3 col-md-offset-1">
		<a href="<?php echo base_url().'index.php/site/detail/'.$col_db->img_karya; ?>" class="thumbnail">
			<img style="width:100%, height=180px" src="<?php echo base_url().'img_karya/carousel/'.$col_db->img_karya; ?>" alt="Image">
		</a>
		<table class="table">
			<tr class="primary">
				<td  style="width: 100px;">Nama Karya</td>
				<td><?= $col_db->nama_karya ?></td>
			</tr>

			<tr>
				<td>Url</td>
				<td><?= $col_db->url_karya ?></td>
			</tr>

			<tr class="primary">
				<td>Dibuat oleh</td>
				<td><?= $col_db->nama ?></td>
			</tr>
		</table>
	</div>
	<div class="col-md-6">
		<p><?= $col_db->detail_karya ?></p>		
	</div>
</div>

<div class="col-md-4 col-md-offset-1">
	<div class="btn btn-info">
		<i class="glyphicon glyphicon-triangle-left"></i> <a href="<?php echo base_url().'index.php/site/tampilan'; ?>" style="color:white; text-decoration: none;"
		>Kembali</a> 
	</div>
</div>

<?php } ?>