<?php include "header.php"; ?>

<?php 

	$funobj = new dbFunction($conn);
	$jobposted = $funobj->getAllJobs();
	if(count($jobposted) == 0){
		$jobposted = [];
	}
	//print_r($allJobs);
?>
<div class="container" id="testp">
	
</div>


<div class="container">

	<h2>Jobs Available</h2><br>
	
	<?php foreach($jobposted as $item): ?>
		
		<div class="col-md-3 col-sm-4 col-xs-6" style="padding: 5px;margin: 5px;height: 360px;width: 250px">

			<div class="card" data-toggle="modal" data-target="#<?php echo $item['JobId']; ?>" >
				<div class="rating" align="right" style="margin: 5px">
				</div>
					<img class="img-responsive" style="height: 220px" src="images/<?php echo $item['CategoryId']; ?>.png">
					<div class="container">
						<h5><b><?php echo $item['JobName']; ?></b></h5> 
						<p>Price Range: ₹<?php echo $item['MinPrice']."-".$item['MaxPrice'];?>
						</p>
						<p>Category: <?php echo $item['CategoryName']; ?></p>			
				</div>
			</div>
		</div>


		<div class="modal fade" id="<?php echo $item['JobId']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel"><?php echo $item['JobName']; ?></h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <?php echo $item['JobDescription']; ?>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" id="applyjob" class="btn btn-primary">Apply</button>
		      </div>
		    </div>
		  </div>
		</div>

			
	<?php endforeach; ?>
</div>

	



<?php include "footer.php"; ?>