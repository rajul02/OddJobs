
<?php  include 'header.php';?>
<?php 

 include_once 'dbFunction.php';
include_once 'dbConnect.php';

  if(isset($_POST['register']))
  {
  echo "<script>window.location.href='register.php'</script>";
  }
$funObj = new dbFunction($conn);
  if(isset($_POST['login'])){
   $userName = $_POST['userName'];
   $pass = $_POST['password'];


$admin=$funObj->admin($pass,$userName);
if($admin){
        $_SESSION["userId"] = 'admin';
      echo "<script>window.location.href='admin.php'</script>";

}
  else{
   $user = $funObj->Login($pass,$userName);
   echo $user;
   if($user){
      $_SESSION["userId"] = $user;
      echo "<script>window.location.href='index.php'</script>";
   }
   else {
    echo " <script>alert('invalid')</script>";
   }
  }
}

?>

<!--
<script src="https://www.gstatic.com/firebasejs/3.7.4/firebase.js"></script>
  <script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-messaging.js"></script>
-->
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyDPWVJyImvZvLD-bjFpfY1EqAg2rW2H-VA",
    authDomain: "alibaba-d3b78.firebaseapp.com",
    databaseURL: "https://alibaba-d3b78.firebaseio.com",
    projectId: "alibaba-d3b78",
    storageBucket: "alibaba-d3b78.appspot.com",
    messagingSenderId: "184167858652"
  };
  firebase.initializeApp(config);
function twitterSignin(){
  var provider = new firebase.auth.TwitterAuthProvider();
firebase.auth().signInWithPopup(provider).then(function(result) {
  // This gives you a the Twitter OAuth 1.0 Access Token and Secret.
  // You can use these server side with your app's credentials to access the Twitter API.
  var token = result.credential.accessToken;
  var secret = result.credential.secret;
  console.log(result);
  // The signed-in user info.
  var user = result.user;
  console.log(user.displayName);


jQuery.ajax({
    type: "POST",
    url: 'check.php',
    data: {functionname: 'loginchecktw', arguments: [user.displayName]},
    error: function(obj,textstatus){
      alert(textstatus);
    },

    success: function (obj, textstatus) {

                  if( obj ) {

                      yourVariable = obj.result;
                      window.location.href = 'index.php';
                      console.log(obj);
                      if(!isset($_SESSION['userId']))
                      {
                        session_start();

                      }

                      window.location.href = 'index.php';
                  }
                  else {
                      console.log(obj.error);
                      window.location.href = 'register.php';
                  }
            }
});





  // ...
}).catch(function(error) {
  // Handle Errors here.
  var errorCode = error.code;
  console.log("error: " + error);
  var errorMessage = error.message;
  // The email of the user's account used.
  var email = error.email;
  // The firebase.auth.AuthCredential type that was used.
  var credential = error.credential;
  // ...
});

}

  
  function googleSignin(){

//alert("rajullll");
var provider = new firebase.auth.GoogleAuthProvider();
     firebase.auth().signInWithPopup(provider).then(function(result) {
  // This gives you a Google Access Token. You can use it to access the Google API.
  var token = result.credential.accessToken;
  console.log(token);
  // The signed-in user info.
  var user = result.user;
  console.log(user.email);
  jQuery.ajax({
    type: "POST",
    url: 'check.php',
    data: {functionname: 'logincheck', arguments: [user.email]},
    error: function(obj,textstatus){
      alert(textstatus);
    },

    success: function (obj, textstatus) {
                console.log(Number(obj));
                  //var rajul = JSON.parse(obj);
                 //console.log(obj.result);

                  if(parseInt(obj)>0){
                    window.location.href = "index.php";
                   
                  }
                   else{
                    // window.location.href = 'register.php';
                   }
            }
    });

  //window.alert(user.email);
  // ...
}).catch(function(error) {
  // Handle Errors here.
  var errorCode = error.code;
  var errorMessage = error.message;
  if(error.code === 'auth/account-exists-with-different-credential'){
    alert(error.email);
  }
  // The email of the user's account used.
  var email = error.email;
  // The firebase.auth.AuthCredential type that was used.
  var credential = error.credential;
  // ...
});

  }
  function facebookSignin(){
  var provider = new firebase.auth.FacebookAuthProvider();
  firebase.auth().signInWithPopup(provider).then(function(result) {
    // This gives you a Facebook Access Token. You can use it to access the Facebook API.
    var token = result.credential.accessToken;
    // The signed-in user info.
    var user = result.user;
    console.log(user.email);
    alert(user.email);
    jQuery.ajax({
    type: "POST",
    url: 'check.php',
    data: {functionname: 'logincheck', arguments: [user.email]},
    error: function(obj,textstatus){
      alert(textstatus);
    },

    success: function (obj, textstatus) {

                  if( obj ) {
                      console.log(obj);
                      window.location.href = 'index.php';
                  }
                  
            }
});
    // ...
  }).catch(function(error) {
    // Handle Errors here.
    var errorCode = error.code;
    console.log(error.code);
    if(error.code === 'auth/account-exists-with-different-credential'){
      alert("error.email");
      jQuery.ajax({
    type: "POST",
    url: 'check.php',
    data: {functionname: 'logincheck', arguments: [error.email]},
    error: function(obj,textstatus){
      alert(textstatus);
    },

    success: function (obj, textstatus) {

                  if( obj ) {
                      console.log(obj);
                      window.location.href = 'index.php';
                  }
                  
            }
});
    }
    var errorMessage = error.message;
    // The email of the user's account used.
    var email = error.email;
    // The firebase.auth.AuthCredential type that was used.
    var credential = error.credential;

    // ...
  });
}

 
</script>






   <div id="login" ng-app="myApp"><center>
   <h1 style=" color: Black; font-family: sans-sherif"><center>Alibaba</center></h1>
   <h2 style=" color: Black; font-family: arial"><center>Login</center></h2>
      <form name="myForm" ng-controller="myCtrl" method="post" action="">

          <input type="text"  name= "userName"  placeholder="Username" required="required" ng-model="userName" >
<span ng-show="myForm.userName.$touched && myForm.userName.$invalid" class="glyphicon glyphicon-remove" aria-hidden = "true" style="color: red"></span>
  <input type="password"  name="password"  placeholder="Password" required="required" ng-model="password" ng-minlength="3">
  <span ng-show="myForm.password.$touched && myForm.password.$invalid" class="glyphicon glyphicon-remove" aria-hidden = "true" style="color: red"></span>

          <input type="submit" ng-click="myFunc()" value="Login" name="login">
         
          <p>The button has been clicked {{count}} times.</p>
         <a class="forgot" href="forgot.php">Forgot Password?</a>
        <br>

        <br>


</form>
      <br>
      <div>
<button onclick="googleSignin()" value="googleSignin" name="googleSignin">Google sign in</button>
<button onclick="twitterSignin()" value="twitterSignin" name="twitterSignin">Twitter sign in</button>
<button onclick="facebookSignin()" value="facebookSignin" name="facebookSignin">Facebook sign in</button>
</div> 
<br>
      <form method="post" action="">
         <input type="submit" value="Register" name="register">
      </form>
        
</center>
    </div>
    </center>

<script>
angular.module('myApp', [])
.controller('myCtrl', ['$scope', function($scope) {
    $scope.count = 0;
    $scope.myFunc = function() {
        console.log($scope.userName);
        console.log($scope.password);
    };
}]);
</script>
<?php  include 'footer.php';?>