<?php

 include_once "dbConnect.php";
include_once "dbFunction.php";
$funobj = new dbFunction($conn);

if(isset($_POST["completejob"])){
	
	$funobj->CompleteJob($_POST['JobId'],$_POST['EmployerId']);
}else
{
	if(isset($_POST['notify'])){
		

		$funobj->NotificationClick($_POST['JobId']);
	}else
	{
		
		$funobj->ApplyJob($_POST['JobId'],$_POST['UserId'],$_POST['EmployerId']);
	}
	
}
?>