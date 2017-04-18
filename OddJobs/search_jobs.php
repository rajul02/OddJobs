<?php
 include 'dbFunction.php';
  include_once 'dbConnect.php';
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 


 
 	if(!isset($_POST['filter'])){
 		$filterby="";
 		$filter="";
 	}else{
 		$filterby=$_POST['filterBy'];
 		$filter=$_POST['filter'];
 	}
 	$search=$_POST['searchTag'];
 	


    $funobj = new dbFunction($conn);
	$hotel=$funobj->search_jobs($filter,$filterby,$search);
  	//print_r($hotel);
  	//echo("<br>");
  	if($hotel){
 	 	$num= $hotel->num_rows;
		$rows = array();
		if($num>0) {
	            $i=0;
	            while($r = $hotel->fetch_assoc()) {
	                array_push($rows,$r);
	            }
		}
		 echo json_encode($rows);
	}else{
		echo("");
	}
	
?>
