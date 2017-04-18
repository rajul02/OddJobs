<?php 
include 'dbFunction.php';
  include_once 'dbConnect.php';


  $funObj = new dbFunction($conn);
//header('Content-Type: application/json');

    $aResult = array();

    if( !isset($_POST['functionname']) ) { $aResult['error'] = 'No function name!'; }

    if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }

    if( !isset($aResult['error']) ) {

        switch($_POST['functionname']) {
            case 'loginfb':
            	echo "string";
               if( !is_array($_POST['arguments']) ) {
                   $aResult['error'] = 'Error in arguments!';
               }
               else {
               		$res = $funObj->Register("default",$_POST['arguments'][0]);
                   $aResult['result'] = $res;

               }
               break;

               case 'logingoo':
            	echo "string";
               if( !is_array($_POST['arguments']) ) {
                   $aResult['error'] = 'Error in arguments!';
               }
               else {
               		$res = $funObj->Register("default",$_POST['arguments'][0]);
                   $aResult['result'] = $res;

               }
               break;

               case 'logintw':
            	echo "string";
               if( !is_array($_POST['arguments']) ) {
                   $aResult['error'] = 'Error in arguments!';
               }
               else {
               		$res = $funObj->Registertw("default",$_POST['arguments'][0]);
                   $aResult['result'] = $res;

               }
               break;

               case 'loginchecktw':
            	echo "string";
               if( !is_array($_POST['arguments']) ) {
                   $aResult['error'] = 'Error in arguments!';
               }
               else {
               		$res = $funObj->userCheck($_POST['arguments'][0]);
                   $aResult['result'] = $res;

               }
               break;

               case 'logincheck':
            	
               if( !is_array($_POST['arguments']) ) {
                   $aResult['error'] = 'Error in arguments!';
               }
               else {
               		$res = $funObj->userCheck($_POST['arguments'][0]);

                   $aResult= $res;


               }
               break;



            default:
               $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
               break;
        }

    }

    echo json_encode($aResult);
?>