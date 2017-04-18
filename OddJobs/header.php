<?php

  if(!isset($_SESSION)) 
  { 
      session_start(); 
  } 

  include_once "dbConnect.php";
  include_once "dbFunction.php";

  $funobj = new dbFunction($conn);

  if(isset($_SESSION['userId'])){
    echo($_SESSION['userId']."<br>");
    $notis = $funobj->getNotification($_SESSION['userId']);
  //  print_r($notis);
  }

?>

<!DOCTYPE html>
<html>
<head>
  <title>Leo</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="dist/css/bootstrap-select.css">
  <link rel="stylesheet" href="dist/css/bootstrap-select.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">

  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

  <script src="https://www.gstatic.com/firebasejs/3.7.4/firebase.js"></script>
  <script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-messaging.js"></script>



  
  <script>

  function log(msg){
    console.log(msg);
  }

  function jobComplete(EmployerId,JobId) {
   // alert(EmployerId + "   " +JobId);
    $.post("applyjob.php", {
      "completejob":1,
      "JobId":JobId,
      "EmployerId":EmployerId
    }, function(result){
      console.log(result);
    });
  }


function notifyClick(id) {
  alert(id);

  $.post("applyjob.php", {
      "notify":1,
      "JobId":id
    }, function(result){
      console.log(result);
    });

}
  function myfunc(id,EmployerId){
    var str = "<?php if(isset($_SESSION['userId']))echo $_SESSION['userId'];?>";
    if(str == ""){
      alert("You have to login!");
      window.location.href = "login.php";
    }else{
        $.post("applyjob.php", {
        "JobId": id,
        "UserId":str,
        "EmployerId":EmployerId
      }, function(result){

          
      });
    }
   // alert(id + " " + str);
  }
    
    $(document).ready(function(){


      
        var page = window.location.href;
       // log(page);
        if(page == "http://localhost/oddjobs/" || page == "http://localhost/oddjobs/index.php"){
          $("#filterValues").selectpicker("hide");
          $("#selectFilter").selectpicker("show");
          $("#searchBox").show();

        }else{
          $("#selectFilter").selectpicker("hide");
          $("#searchBox").hide();
        }

        $("#filterValues").selectpicker("hide");

        $(".rateEmploye").change(function(){
            var jobId = $(".rateEmploye option:selected").val();
            var value = $(".rateEmploye option:selected").text();

            alert(jobId+" " + value);

        });

        $("#selectFilter").change(function(){
         // alert($("#selectFilter option:selected").text());

         var filterBy = $("#selectFilter option:selected").val();
         console.log(filterBy);
            $.post("getFilterValues.php",
            {
                filter: filterBy,
            },
            function(data, status){
                
                if(filterBy == "location"){
                
                  var data = JSON.parse(data);
                  $("#filterValues").empty();
                  for(i in data){
                //    log(data[i]);
                    var option = new Option(data[i],data[i]);
                    $("#filterValues").append($(option));
                  }
                  $("#filterValues").selectpicker('refresh');
                  $("#filterValues").selectpicker("show");
                }else if(filterBy == "price"){
                  var data = JSON.parse(data);
                  $("#filterValues").empty();
                  for(i in data){
                   // console.log(data[i]);
                    var option = new Option(data[i],data[i]);
                    $("#filterValues").append($(option));
                  }
                  $("#filterValues").selectpicker('refresh');
                  $("#filterValues").selectpicker("show");
                }else if(filterBy == "category"){
                  //$("#testp").empty();
                  //$("#testp").append(data);
                  var data = JSON.parse(data);
                  $("#filterValues").empty();
                  for(i in data){
                    log(data[i][1]);
                    var option = new Option(data[i][1],data[i][0]);
                    $("#filterValues").append($(option));
                  }
                  $("#filterValues").selectpicker('refresh');
                  $("#filterValues").selectpicker("show");
                }
            });
        });

    $("#filterValues").change(function(){
        var filterBy = $("#selectFilter option:selected").val();
         var filter = $("#filterValues option:selected").val();
         var searchTag =  $("#searchBox").val();
          $.post("search_jobs.php",
          {
              "filterBy": filterBy,
              "filter": filter,
              "searchTag": searchTag

          },
          function(data, status){
              log(data);
              $("#testp").empty();
              $("#testp").append("<h2>Search Result</h2><br>");
              var data = JSON.parse(data);

              for(i in data){
                $("#testp").append("<div class='col-md-3 col-sm-4 col-xs-6' style='padding: 5px;margin: 5px;height: 360px;width: 250px'><div class='card' data-toggle='modal' data-target='#"+data[i]['JobId']+"'><div class='rating' align='right' style='margin: 5px'></div><img class='img-responsive' style='height: 220px' src='images/"+data[i]['CategoryId']+".png'><div class='container'><h5><b>" +data[i]['JobName']+ "</b></h5><p>Price Range: ₹"+data[i]['MinPrice']+"-"+data[i]['MaxPrice']+"</p><p>Category: "+data[i]['CategoryName']+"</p></div></div></div>"

                  + "<div class='modal fade' id='"+data[i]['JobId']+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header'><h5 class='modal-title' id='exampleModalLabel'>"+data[i]['JobName']+"</h5><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div><div class='modal-body'>"+data[i]['JobDescription']+"</div><div class='modal-footer'><button type='butto' class='btn btn-secondary' data-dismiss='modal'>Close</button><button type='button' id='apply' onclick='myfunc("+data[i]['JobId'] +","+data[i]['EmployerId']+")' value = '"+data[i]['JobId']+" ' class='btn btn-primary' data-dismiss='modal'>Apply</button></div></div></div></div>");
              }
              


          });
    });

    $("#searchBox").on("input",function(){
       // console.log($("#searchBox").val());
         var filterBy = $("#selectFilter option:selected").val();
         var filter = $("#filterValues option:selected").val();
         var searchTag =  $("#searchBox").val();
          $.post("search_jobs.php",
          {
              "filterBy": filterBy,
              "filter": filter,
              "searchTag": searchTag

          },
          function(data, status){
              log(data);
              $("#testp").empty();
              $("#testp").append("<h2>Search Result</h2><br>");
             var data = JSON.parse(data);
              for(i in data){
                $("#testp").append("<div class='col-md-3 col-sm-4 col-xs-6' style='padding: 5px;margin: 5px;height: 360px;width: 250px'><div class='card' data-toggle='modal' data-target='#"+data[i]['JobId']+"'><div class='rating' align='right' style='margin: 5px'></div><img class='img-responsive' style='height: 220px' src='images/"+data[i]['CategoryId']+".png'><div class='container'><h5><b>" +data[i]['JobName']+ "</b></h5><p>Price Range: ₹"+data[i]['MinPrice']+"-"+data[i]['MaxPrice']+"</p><p>Category: "+data[i]['CategoryName']+"</p></div></div></div>"

                  + "<div class='modal fade' id='"+data[i]['JobId']+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header'><h5 class='modal-title' id='exampleModalLabel'>"+data[i]['JobName']+"</h5><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div><div class='modal-body'>"+data[i]['JobDescription']+"</div><div class='modal-footer'><button type='butto' class='btn btn-secondary' data-dismiss='modal'>Close</button><button type='button' id='apply' onclick='myfunc("+data[i]['JobId']+","+data[i]['EmployerId']+")' class='btn btn-primary' data-dismiss='modal'>Apply</button></div></div></div></div>");
              }
          });
    });

    });


  </script>
</head>
<body>


<!--Navbar Start-->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">
       <img alt="Brand" src="images/leo.jpg" style="width: 30px;height: 30px" >
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
        <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <select id="selectFilter" class="selectpicker" title="Select Filter...">
            
              <option value="location">Location</option>
              <option value="category">Category</option>
              <option value="price">Price</option>
            
          </select>
        </div>

        <div class="form-group" id="filterValuesDiv">
      
          <div class="col-lg-10">
            <select id="filterValues" class= "selectpicker show-tick" multiple data-max-options="1" data-live-search="true" required>
              
            </select>
          </div>
        </div>

        <div class="input-group">
          <input id="searchBox" type="text" class="form-control" placeholder="Search">

          <div class="input-group-btn">
            <p><i class="glyphicon glyphicon-search"></i></p>
          </div>
        </div>
        
      </form>
      </ul>
      <ul class="nav navbar-nav navbar-right" style="float: right;">

      <?php if(!isset($_SESSION['userId'])): ?>
        <li><a href="login.php">Login</a></li>
        
      <?php else: ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Notification <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <?php foreach($notis as $val): ?>
            <?php if($val['SeenStatus'] == 0): ?>
              <?php if(strpos($val['message'], 'completed') == true): ?>
                <li data-toggle="modal" data-target="#<?php echo $val['JobId']; ?>"  style="background-color:#d1d1e0"><a href="#"><?php echo($val['message']." Job Id: ".$val['JobId']); ?></a></li>

                  

              <?php else: ?>
              <li onclick=notifyClick("<?php echo $val['Id'];?>")  style="background-color:#d1d1e0"><a href="#"><?php echo($val['message']." Job Id: ".$val['JobId']); ?></a></li>
            <?php endif; ?>
              <li style="background-color:#d1d1e0" role="separator" class="divider"></li>
            <?php else: ?>
              <li><a href="#"><?php echo($val['message']." Job Id: ".$val['JobId']); ?></a></li>
              <li role="separator" class="divider"></li>
            <?php endif; ?>
             
          <?php endforeach?>
           
          </ul>
        </li>
        <li><a href="postjobs.php">Post Job</a></li>
        <li><a href="your_job.php">My Jobs</a></li>
        <li><a href="userProfile.php">My Profile</a></li>
        <li><a href="logout.php">Log out</a></li>

        
      <?php endif; ?> 
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<?php 

if(isset($notis))
foreach($notis as $val): ?>
            <?php if($val['SeenStatus'] == 0): ?>
              <?php if(strpos($val['message'], 'completed') == true): ?>
                
                  <div class="modal fade" id="<?php echo $val['JobId']; ?>" role="dialog" aria-labelledby="  exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Rate Employee</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="form-group">
                                <select id="rate<?php echo $val['JobId'];?>" onchange="rate(<?php echo $val['JobId'];?>)" class="selectpicker " title="Select Filter...">
                                  
                                    <option value="<?php echo $val['Id'];?>">1</option>
                                    <option value="<?php echo $val['Id'];?>">2</option>
                                    <option value="<?php echo $val['Id'];?>">3</option>
                                    <option value="<?php echo $val['Id'];?>">4</option>
                                    <option value="<?php echo $val['Id'];?>">5</option>
                                    <option value="<?php echo $val['Id'];?>">6</option>
                                    <option value="<?php echo $val['Id'];?>">7</option>
                                    <option value="<?php echo $val['Id'];?>">8</option>
                                    <option value="<?php echo $val['Id'];?>">9</option>
                                    <option value="<?php echo $val['Id'];?>">10</option>
                                    
                                </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="button" onclick=notifyClick("<?php echo $val['Id'];?>") id="applyjob" class="btn btn-primary">Apply</button>
                            </div>
                          </div>
                        </div>
                      </div>



                  <script>
                    
                  function rate(id){
                    //alert(id + " " + $("#rate"+id+" option:selected").text());
                    var rateVal = $("#rate"+id+" option:selected").text();
                    $.post("rate.php", {
                          "jobId":id,
                          "rateValue": rateVal
                        }, function(result){
                          console.log(result);
                        });

                  }

                  </script>


              
            <?php endif; ?>
          <?php endif; ?>
<?php endforeach?>


<!--Navbar Ends-->

