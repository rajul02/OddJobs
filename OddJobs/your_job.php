<?php include 'header.php'; ?>


<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    if(isset($_SESSION['userId'])){
    	
    	

		$funobj = new dbFunction($conn);

		$jobposted = $funobj->getJobByUserId($_SESSION['userId']);
		if(count($jobposted) == 0){
			$jobposted = [];
		}

		$jobsToBeDone = $funobj->getJobsByEmployeId($_SESSION['userId']);
		$jobCopleted = array();
		$jobsongoing = array();
		if(count($jobposted) == 0){
			$jobposted = [];
			$jobCopleted = [];
			$jobsongoing = [];
		}else{
			//print_r($jobposted);
			foreach ($jobsToBeDone as $value) {
				if(strcmp($value['status'],"completed")==0){
					array_push($jobCopleted,$value);

				}else{
					array_push($jobsongoing,$value);
				}
			}
		}		
		
	

    }else {

    	header("Location: index.php");
    }

    if(isset($_POST['remove_product'])) {
    	if($funobj->removeProduct($_POST['remove_product'])) {
    		header("Location: your_items.php");
    		die();
    	}else {
    		echo "Delete Failed";
    	}
    }

   
?>


 <link rel="stylesheet" href="style.css">
<div class="container">
	<h2>Jobs Posted</h2>
	<?php foreach($jobposted as $item): ?>
		
		<div class="col-md-3 col-sm-4 col-xs-6" style="padding: 5px;margin: 5px;height: 360px;width: 250px">

			<div class="card">
				<div class="rating" align="right" style="margin: 5px">
				<!--<form action="" method="post">
					 <button type="submit" name="remove_product" value=<?php echo $item['item_ID'];?>><i class="glyphicon glyphicon-remove"></i></button> 
				</form> -->
					
				</div>
					<img class="img-responsive" style="height: 220px" src="images/<?php echo $item['CategoryId']; ?>.png">
					<div class="container">

						<h5><b><?php echo $item['JobName']; ?></b></h5> 
						<p>Price Range: ₹<?php echo $item['MinPrice']."-".$item['MaxPrice'];?>
						</p>
						<?php if($item['active'] == 0):?>
							<p>Status: <?php echo "In Active"; ?></p>
						<?php else: ?>
							<p>Status: <?php echo "Active"; ?></p>
						<?php endif; ?>
					</div>
			</div>
					
		</div>

			<div class="modal fade bs-<?php echo $item['item_ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
			  <div class="modal-dialog modal-sm" role="document">
			    <div class="modal-content">
			    	<div class="modal-body">
			    		<p>Are You Sure you want to remove Product: <?php echo $item['item_title']; ?></p>
			      	</div>
			      	<form action="" method="post">
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        
			        <button type="submit" name="remove_product" value=<?php echo $item['item_ID'];?> class="btn btn-primary">Delete</button>
			       
			      </div>
			       </form>
			    </div>
			  </div>
			</div>



			<div class="modal fade stop-<?php echo $item['item_ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
			  <div class="modal-dialog modal-sm" role="document">
			    <div class="modal-content">
			    	<div class="modal-body">
			    		<p>Are You Sure you want to stop bidding for Product: <?php echo $item['item_title']; ?></p>
			      	</div>
			      	<form action="" method="post">
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        
			        <button type="submit" name="stopbid" value=<?php echo $item['item_ID'];?> class="btn btn-primary">Stop Bid</button>
			       
			      </div>
			       </form>
			    </div>
			  </div>
			</div>
	<?php endforeach; ?>

</div>
<div class="container">
<h2>Jobs Ongoing</h2>

	<?php foreach($jobsongoing as $item): ?>
		
		<div class="col-md-3 col-sm-4 col-xs-6" style="padding: 5px;margin: 5px;height: 360px;width: 250px">

			<div class="card">
				<div class="rating" align="right" style="margin: 5px">
				<!--<form action="" method="post">
					 <button type="submit" name="remove_product" value=<?php echo $item['item_ID'];?>><i class="glyphicon glyphicon-remove"></i></button> 
				</form> -->
					<button type="button" onClick=jobComplete(<?php echo $item['EmployerId']?>,<?php echo $item['JobId']?>) class="btn btn-primary" style="background-color: red"><i class="glyphicon glyphicon-remove"></i></button>
				</div>
					<img class="img-responsive" style="height: 220px" src="images/<?php echo $item['CategoryId']; ?>.png">
					<div class="container">

						<h5><b><?php echo $item['JobName']; ?></b></h5> 
						<p>Price Range: ₹<?php echo $item['MinPrice']."-".$item['MaxPrice'];?>
						</p>
						<?php if($item['active'] == 0):?>
							<p>Status: <?php echo "In Active"; ?></p>
						<?php else: ?>
							<p>Status: <?php echo "Active"; ?></p>
						<?php endif; ?>
					</div>
			</div>
					
		</div>

			<div class="modal fade bs-<?php echo $item['item_ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
			  <div class="modal-dialog modal-sm" role="document">
			    <div class="modal-content">
			    	<div class="modal-body">
			    		<p>Are You Sure you want to remove Product: <?php echo $item['item_title']; ?></p>
			      	</div>
			      	<form action="" method="post">
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        
			        <button type="submit" name="remove_product" value=<?php echo $item['item_ID'];?> class="btn btn-primary">Delete</button>
			       
			      </div>
			       </form>
			    </div>
			  </div>
			</div>



			<div class="modal fade stop-<?php echo $item['item_ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
			  <div class="modal-dialog modal-sm" role="document">
			    <div class="modal-content">
			    	<div class="modal-body">
			    		<p>Are You Sure you want to stop bidding for Product: <?php echo $item['item_title']; ?></p>
			      	</div>
			      	<form action="" method="post">
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        
			        <button type="submit" name="stopbid" value=<?php echo $item['item_ID'];?> class="btn btn-primary">Stop Bid</button>
			       
			      </div>
			       </form>
			    </div>
			  </div>
			</div>
	<?php endforeach; ?>

</div>
<div class="container">
<h2>Completed Jobs</h2>

	<?php foreach($jobCopleted as $item): ?>
		
		<div class="col-md-3 col-sm-4 col-xs-6" style="padding: 5px;margin: 5px;height: 360px;width: 250px">

			<div class="card">
				<div class="rating" align="right" style="margin: 5px">
				<!--<form action="" method="post">
					 <button type="submit" name="remove_product" value=<?php echo $item['item_ID'];?>><i class="glyphicon glyphicon-remove"></i></button> 
				</form> -->
					</div>
					<img class="img-responsive" style="height: 220px" src="images/<?php echo $item['CategoryId']; ?>.png">
					<div class="container">

						<h5><b><?php echo $item['JobName']; ?></b></h5> 
						<p>Price Range: ₹<?php echo $item['MinPrice']."-".$item['MaxPrice'];?>
						</p>
						<?php if($item['active'] == 0):?>
							<p>Status: <?php echo "In Active"; ?></p>
						<?php else: ?>
							<p>Status: <?php echo "Active"; ?></p>
						<?php endif; ?>
					</div>
			</div>
					
		</div>

			<div class="modal fade bs-<?php echo $item['item_ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
			  <div class="modal-dialog modal-sm" role="document">
			    <div class="modal-content">
			    	<div class="modal-body">
			    		<p>Are You Sure you want to remove Product: <?php echo $item['item_title']; ?></p>
			      	</div>
			      	<form action="" method="post">
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        
			        <button type="submit" name="remove_product" value=<?php echo $item['item_ID'];?> class="btn btn-primary">Delete</button>
			       
			      </div>
			       </form>
			    </div>
			  </div>
			</div>



			<div class="modal fade stop-<?php echo $item['item_ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
			  <div class="modal-dialog modal-sm" role="document">
			    <div class="modal-content">
			    	<div class="modal-body">
			    		<p>Are You Sure you want to stop bidding for Product: <?php echo $item['item_title']; ?></p>
			      	</div>
			      	<form action="" method="post">
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        
			        <button type="submit" name="stopbid" value=<?php echo $item['item_ID'];?> class="btn btn-primary">Stop Bid</button>
			       
			      </div>
			       </form>
			    </div>
			  </div>
			</div>
	<?php endforeach; ?>


</div>

		
	
	


<?php include 'footer.php'; ?>