<?php

	include_once 'dbConnect.php';

	if(isset($_POST["filter"])){
		//echo(strcasecmp($_POST["filter"],"City"));
		if(strcasecmp($_POST["filter"],"location") == 0){

			
			$query = "SELECT DISTINCT `location` FROM `jobdetail` where active = 1 and status='waiting' ORDER BY location";

			$result = mysqli_query($conn,$query);
	//		echo mysqli_error($this->db);
	
			if ($result->num_rows > 0) {
				$data = array();
				//$row = mysqli_fetch_array($result,MYSQLI_NUM);
			    // output data of each row
			    while($row = mysqli_fetch_assoc($result)) {
			    	//print_r($row["location"]);
			       array_push($data,$row["location"]);
			    }
				echo(json_encode($data));
			}

		}else if(strcasecmp($_POST["filter"],"category") == 0){

			$query = "select DISTINCT categoryid, categoryname from category, jobdetail where category.CategoryId = jobdetail.JobCategory and active = 1 and status='waiting' ORDER BY categoryname";

			$result = mysqli_query($conn,$query);
	//		echo mysqli_error($this->db);
	
			if ($result->num_rows > 0) {
				$data = array();
				//$row = mysqli_fetch_array($result,MYSQLI_NUM);
			    // output data of each row
			    while($row = mysqli_fetch_assoc($result)) {
			    //	print_r($row['categoryid']);
			       array_push($data,array($row['categoryid'],$row['categoryname']));
			    }
			    //print_r($data);
				echo(json_encode($data));
			}
		}else if(strcasecmp($_POST["filter"],"price") == 0){
			$data = array("0-199","200-499","500-799","800-1200","1200-1800","1800-2500");
			echo(json_encode($data));
		}
	}

?>