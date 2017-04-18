<?php

 include_once "dbConnect.php";
include_once "dbFunction.php";
$funobj = new dbFunction($conn);

$jobId = $_POST['jobId'];
$rateValue = $_POST['rateValue'];
$funobj->rateEmploye($jobId, $rateValue);


?>