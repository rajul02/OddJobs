<?php 
include 'dbFunction.php';
  include_once 'dbConnect.php';


  $funObj = new dbFunction($conn);
//header('Content-Type: application/json');

    $aResult = array();


if(isset($_POST['functionname'])){

        switch($_POST['functionname']) {
            case 'inactive':
               
               		$res = $funObj->inactive();
                  $num= $res->num_rows;
  if($num>0) {
            $i=0;
            while($r = $res->fetch_assoc()) {
                array_push($aResult,$r);
            }
  }

               
               break;

            case 'waiting':
            $res = $funObj->waiting();
                  $num= $res->num_rows;
  if($num>0) {
            $i=0;
            while($r = $res->fetch_assoc()) {
                array_push($aResult,$r);
            }
  }
            break;

            case 'active':
            $res = $funObj->active();
                  $num= $res->num_rows;
  if($num>0) {
            $i=0;
            while($r = $res->fetch_assoc()) {
                array_push($aResult,$r);
            }
  }
            break;

            case 'complete':
            $res = $funObj->complete();
                  $num= $res->num_rows;
  if($num>0) {
            $i=0;
            while($r = $res->fetch_assoc()) {
                array_push($aResult,$r);
            }
  }
            break;

            case 'donepuser':
 $res = $funObj->done_per_user();
                  $num= $res->num_rows;
  if($num>0) {
            $i=0;
            while($r = $res->fetch_assoc()) {
                array_push($aResult,$r);
            }
  }
            break;
           case 'postpuser':
 $res = $funObj->post_per_user();
                  $num= $res->num_rows;
  if($num>0) {
            $i=0;
            while($r = $res->fetch_assoc()) {
                array_push($aResult,$r);
            }
  }
            break;

            case 'category':
 $res = $funObj->category();
                  $num= $res->num_rows;
  if($num>0) {
            $i=0;
            while($r = $res->fetch_assoc()) {
                array_push($aResult,$r);
            }
  }
            break;
  case 'rating':
 $res = $funObj->getRating();
                  $num= $res->num_rows;
  if($num>0) {
            $i=0;
            while($r = $res->fetch_assoc()) {
                array_push($aResult,$r);
            }
  }
            break;






                    }



    echo json_encode($aResult);
  }

  if(isset($_POST['active'])){


            $res = $funObj->makeActive($_POST['hid']);
            if($res){
                    echo "<script>
                    alert('activeted');
                    window.location.href='admin.php'</script>";

            }
            else{
                    echo "<script>
                    alert(' Not activeted...error');
                    window.location.href='admin.php'</script>";


            }



  }
?>