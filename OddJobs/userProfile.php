
<?php 


  include "header.php";
  include_once "dbConnect.php";
  include_once "dbFunction.php";
    //$_SESSION['userId']= 16;
  echo $_SESSION['userId'];
    if(isset($_SESSION['userId'])){
    
  
    $funObj = new dbFunction($conn);

    $data = $funObj->getUserDetail($_SESSION['userId']);
	 if(count($data) > 0)
	 {
		 $name=$data['userName'];
		 $email=$data['email'];
		 $phone=$data['prefferedCategory'];
		}


    }else {
      echo "<script>
alert('Login First');
window.location.href='login.php';
</script>";

      
    }

      if(isset($_POST['Save'])){
        $name2=$_POST['userName'];
        $email2=$_POST['email'];
        $phone2=$_POST['prefferedCategory'];
        $id=$_SESSION['userId'];

        //echo "string";

       $user = $funObj->UpdateUser($id,$name2,$email2,$phone2);
      // print_r($user);
       if($user===True){
         //echo "<script>alert('Changes Saved');</script>";
        echo($user);
       }
       else{
        echo $funObj->db->error;
         //echo "<script>
//alert('Error in saving changes');
//</script>";

       }


      }
      if(isset($_POST['save_pass'])){
        $new=$_POST['newpassword'];
        $old=$_POST['cpassword'];
        $id=$_SESSION['userId'];
       if($old==$data['password']){
		$user = $funObj->ChangePassword($id,$new);
		if($user===True){
         echo "<script>
		alert('Password changed');
		</script>";
       }
       else{
        echo $funObj->db->error;
         //echo "<script>
//alert('Error in saving changes');
//</script>";

       }

	   }
	   else{
		 echo "<script>
		alert('Old password is wrong');
		</script>";
  
	   }
	   
       

      }





  
?>







<?php if(count($data) > 0): ?>
  <div style=""  ng-app="myApp" 
        ng-controller="myController">
   <div id="login"  style="margin-left:200px;"><center>
   <h2 style=" color: Black; font-family: arial"><center>Edit Profile</center></h2>
      <form name='register' method="post"   action="" >

         <span id="icon" class="glyphicon glyphicon-pencil"></span>
         <p>Name:&nbsp;&nbsp;&nbsp; 
		 <input type="text" id="user" name= "userName"   required="required" value="<?php echo $name;?> " ></p>
         <span id="icon" class="glyphicon glyphicon-pencil"></span>

       
        <p> Email:&nbsp;&nbsp;&nbsp; <input type="email" id="email" name="email" value="<?php echo $email;?>" required="required" ></p>
         <span id="icon" class="glyphicon glyphicon-pencil"></span>

       
         <p> Cat:&nbsp;&nbsp;&nbsp; <input type="text" id="phone" name= "prefferedCategory" required="required"  value="<?php echo $phone;?>" ></p>
         
       
	   



        
          <input type="submit"  value="Save Changes"  name="Save">
      </form>
	  <br>
	  <br>
	  </div>
   <div id="login"  style=" position:fixed; left:700px; top:120px;"><center>
	  <form>
      <input type="submit" ng-click="showTheForm = !showTheForm" value="Change Password"/>
	  </form>
      <form ng-show="showTheForm"  method="post" action="" name="change">
          <input type="password" id="oldpassword" name="cpassword"  placeholder=" Enter Old Password" required="required" ng-model="cpassword"> 
          <span ng-show="change.cpassword.$touched && change.cpassword.$invalid" class="glyphicon glyphicon-remove" aria-hidden = "true" style="color: red"></span>
		<input type="password" id="newpassword" name="newpassword"  placeholder=" Enter New Password" required="required" ng-model="newpassword"> 
        <span ng-show="change.newpassword.$touched && change.newpassword.$invalid" class="glyphicon glyphicon-remove" aria-hidden = "true" style="color: red"></span>
		<input type="password" id="rpassword" name="rpassword"  placeholder=" Reenter New Password" required="required" ng-model="rpassword" > 
        <span ng-show="change.rpassword.$touched && change.rpassword.$invalid " class="glyphicon glyphicon-remove" aria-hidden = "true" style="color: red" ></span>

<input type="submit"  value="Save Changes"  name="save_pass">

	
</form>
</center>
</div>
    </center>

    </div>
    </div>
	<script>
angular.module('myApp', [])
.controller('myController', ['$scope', function($scope) {
    $scope.showTheForm = false;
	
    $scope.processForm = function() {
    // execute something
    $scope.showTheForm = false;
}

}]);
angular.module('myApp.directives', [])
  .directive('pwCheck', [function () {
    return {
      require: 'ngModel',
      link: function (scope, elem, attrs, ctrl) {
        var firstPassword = '#' + attrs.pwCheck;
        elem.add(firstPassword).on('keyup', function () {
          scope.$apply(function () {
            var v = elem.val()===$(firstPassword).val();
            ctrl.$setValidity('pwmatch', v);
          });
        });
      }
    }
  }]);
</script>
>

<?php endif; ?>




<?php include 'footer.php'; ?>
