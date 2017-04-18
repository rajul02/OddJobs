<?php  include 'header.php';?>


<?php 

 include_once 'dbFunction.php';
  include_once 'dbConnect.php';


  $funObj = new dbFunction($conn);

  if(isset($_POST['register']))
  {

    $email = $_POST['userName'];

    $password =md5($_POST['password']);

    $user = $funObj->Register($password,$email);
    if($user==true){
    echo "<script>
alert('Successfully register');
window.location.href='userProfile.php';
</script>";
}
else{
      echo "<script>
alert('Email Already Exist');
</script>";

}

    
  }

  if(isset($_POST['login11']))
  {
    
    header("Location: login.php");
  }

?>


<!--<script src="https://www.gstatic.com/firebasejs/3.7.4/firebase.js"></script>
  <script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-messaging.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->

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
    data: {functionname: 'logintw', arguments: [user.displayName]},
    error: function(obj,textstatus){
      alert(textstatus);
    },

    success: function (obj, textstatus) {

                  if( obj ) {

                      yourVariable = obj.result;
                      console.log(obj);
                      window.location.href = 'userProfile.php';
                  }
                  else {
                      console.log(obj.error);
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
    //console.log(user.email);
    if(user.email != null){
          jQuery.ajax({
          type: "POST",
          url: 'check.php',
          data: {functionname: 'logingoo', arguments: [user.email]},
          error: function(obj,textstatus){
            alert(textstatus);
          },

          success: function (obj, textstatus) {
                 yourVariable = obj.result;
                  console.log(obj);
                  console.log(textstatus);
      //         window.location.href = 'userProfile.php';
                      
                  }
    });

    }
    
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
    jQuery.ajax({
    type: "POST",
    url: 'check.php',
    data: {functionname: 'loginfb', arguments: [user.email]},
    error: function(obj,textstatus){
      alert(textstatus);
    },

    success: function (obj, textstatus) {
      //alert("bla");
                  if( obj ) {

                      yourVariable = obj.result;
                      console.log(obj);
                      window.location.href = 'userProfile.php';
                  }
                  else {
                      console.log(obj.error);
                  }
            }
});
    alert(user.email);
    // ...
  }).catch(function(error) {
    // Handle Errors here.
    var errorCode = error.code;
    console.log(error.code);
    if(error.code === 'auth/account-exists-with-different-credential'){
      alert(error.email);
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




<div style="">
   <div id="login" ng-app="myApp" style=""><center>
   <h1 style=" color: Black; font-family: sans-sherif"><center>Alibaba</center></h1>
   <h2 style=" color: Black; font-family: arial"><center>Register</center></h2>
      <form name='register' method="post"   action="">

       
          <input type="email" id="user" name= "userName"  placeholder="User Email" required="required" ng-model="userName">
<span ng-show="register.userName.$touched && register.userName.$invalid" class="glyphicon glyphicon-remove" aria-hidden = "true" style="color: red"></span>
       
          <input type="password" id="pass" name="password"  placeholder="Password" required="required" ng-model="password" ng-minlength="5">
<span ng-show="register.password.$touched && register.password.$invalid" class="glyphicon glyphicon-remove" aria-hidden = "true" style="color: red"></span>

       
          <input type="password" id="pass" name="rpassword"  placeholder=" Renter Password" required="required" ng-model="rpassword"> 
          <span ng-show="register.rpassword.$touched && register.rpassword.$invalid" class="glyphicon glyphicon-remove" aria-hidden = "true" style="color: red"></span>
     
        
          <input type="submit" value="register" name="register">
      </form>
       <br>
       <div>
<button onclick="googleSignin()" value="googleSignin" name="googleSignin">Google sign in</button>
<button onclick="twitterSignin()" value="twitterSignin" name="twitterSignin">Twitter sign in</button>
<button onclick="facebookSignin()" value="facebookSignin" name="facebookSignin">Facebook sign in</button>
</div> 
<br>
       <p>Already Registered?</p>
      <form method="post" action="">
        <input type="submit" value="Login here" name="login11">
      </form>
      </center>
    </div>
    </div>
    </center>
<?php include "footer.php" ; ?>