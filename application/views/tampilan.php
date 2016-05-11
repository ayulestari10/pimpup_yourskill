<?php $col_db = $this->db->query("SELECT * FROM input_karya ORDER BY id_karya DESC LIMIT 5"); ?>

<div class="row" style="margin-top: 3%;">
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	  <!-- Indicators -->
	  <ol class="carousel-indicators">
	  	<?php $i = 0; foreach ($col_db->result() as $col): 
	  		if ($i == 0) { ?>
			    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			<?php } else { ?>
				<li data-target="#carousel-example-generic" data-slide-to="<?= $i ?>"></li>
			<?php } ?>
			<?php $i++; ?>
		<?php endforeach; ?>
	  </ol>

	  <div class="carousel-inner" role="listbox">
	  	<?php $i = 1; foreach ($col_db->result() as $col): 
	  		if ($i == 1) { ?>
			    <div class="item active">
			       <a href="<?php echo base_url().'index.php/site/detail/'.$col->id_karya; ?>">
				      <img style="width: 1578px; height: 700px" src="<?= base_url('img_karya/' . $col->id_karya . ".png") ?>"/>
				   </a>
			      <div class="carousel-caption">
			        <a href="<?php echo base_url().'index.php/site/detail/'.$col->id_karya; ?>">
			        	<h1><?php echo $col->nama_karya; ?></h1>
			        </a>
			      	<p>
			      		<?php 
			      			$detailp = substr($col->detail_karya, 0, 350); 
			      			echo $detailp.'
			      			 ...';
			      		?>
			      		<a href="<?php echo base_url().'index.php/site/detail/'.$col->id_karya; ?>" style="color:white; text-decoration: none;">Read More  <i class="glyphicon glyphicon-triangle-right"></i></a>		      		
			      	</p>
			      </div>
			    </div>
			    <?php $i++; ?>
			<?php } else { ?>
				<div class="item">
			      <img style="width: 1578px; height: 700px" src="<?= base_url('img_karya/' . $col->id_karya . ".png") ?>"/>
			      <div class="carousel-caption">
			        <a href="<?php echo base_url().'index.php/site/detail/'.$col->id_karya; ?>">
			        	<h1><?php echo $col->nama_karya; ?></h1>
			        </a>
			        <p>
			      		<?php 
			      			$detailp = substr($col->detail_karya, 0, 350); 
			      			echo $detailp.'
			      			 ...';
			      		?>
			      		<a href="<?php echo base_url().'index.php/site/detail/'.$col->id_karya; ?>" style="color:white; text-decoration: none;">Read More  <i class="glyphicon glyphicon-triangle-right"></i></a>
			      	</p>
			      </div>
			    </div>
			<?php } ?>
		<?php endforeach; ?>
	  </div>

	  <!-- Wrapper for slides -->
	  <div class="carousel-inner" role="listbox">
	  	<?php foreach($col_db->result() as $col): ?> 
	    <div class="item">
	    	<a href="<?php echo base_url().'index.php/site/detail/'.$col->id_karya; ?>">
	    		<img src="<?php echo base_url().'img_karya/'.$col->img_karya; ?>" alt="Image!">
	    	</a>
	    </div>
	  	<?php endforeach; ?>
	  </div>


	  <!-- Controls -->
	  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
	    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
	    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	  </a>
	</div>
</div>
<br/>
<br/>
<br/>
<?php
	$start = 5 + $page_data;
	$rows = 8;
	
	$col_db2 = $this->db->query("SELECT * FROM input_karya ORDER BY id_karya DESC LIMIT " . $start . ", " . $rows);

?>

<div class="container">
	<div class="row">
		<?php foreach($col_db2->result() as $col): ?>	
		<div class="col-xs-6 col-md-4" style="text-align: center; margin-top: 5%;" width=150 height=100>
			<a href="<?php echo base_url().'index.php/site/detail/'.$col->id_karya; ?>" class="thumbnail">
			  <img style="width:100%, height=180px" src="<?php echo base_url().'img_karya/'.$col->id_karya.'.png'; ?>" alt="Image">
			</a>
			<?php 
				echo "<h2>".$col->nama_karya."</h2>"; 
				$detail = substr($col->detail_karya,0,100);
				echo "<p style='color:white;'>".$detail."...</p>";
			?>
			<div class="btn btn-info" style="float:left;">
				<a href="<?php echo base_url().'index.php/site/detail/'.$col->id_karya; ?>" style="color:white; text-decoration: none; float:right;"
				>Detail  <i class="glyphicon glyphicon-triangle-right"></i></a>
			</div>
		</div>
	  <?php endforeach; ?>
	</div>
</div>

<div class="col-md-4 col-md-offset-5" style="margin-bottom: 2%; margin-top: 2%;">
	<?php echo $pagination; ?>
</div>