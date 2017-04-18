<?php include 'header.php';?>
<?php
include_once 'dbFunction.php';
  include_once 'dbConnect.php';


  $funObj = new dbFunction($conn);
  $res=$funObj->getAllUser();
  $users=array();
   $num= $res->num_rows;
  if($num>0) {
            while($r = $res->fetch_assoc()) {
                array_push($users,$r);
            }
  }
      $users= json_encode($users);


?>
<style>
table, th, td {
    border: 1px double green;
        text-align: center;


}
table{
	    border-collapse: separate;

}
th ,td{
    width: 120px; 
    padding-top: 5px;


}

</style>

<script >
	function inactive(){
		    $('#inactive').css("background", "blue");
		jQuery.ajax({
    type: "POST",
    url: 'admin_fetch.php',
    data: {functionname: 'inactive'},
    error: function(obj,textstatus){
      alert(textstatus);
    },

    success: function (data, textstatus) {

                  if( data ) {
                  		$('#details').empty();
                  		 var dataArray = JSON.parse(data);
                  		if(dataArray.length>0){
                  		$('#details').append("<table><tr><th>Job_id</th><th>Name</th><th>Description</th><th>Category</th><th>MaxPrice</th><th>MinPrice</th><th>Employer</th><th>Date</th><th>active</th><th>location</th><th>make<br>active</th></tr>");
                   for(i=0;i<dataArray.length;i++){
                   	             var obj = dataArray[i];
                   	 $('#details').append("<tr><td>"+obj['JobId']+"</td><td>"+obj['JobName']+"</td><td>"+obj['JobDescription']+"</td><td>"+obj['CategoryName']+"</td><td>"+obj['MaxPrice']+"</td><td>"+obj['MinPrice']+"</td><td>"+obj['userName']+"</td><td>"+obj['Date']+"</td><td>"+obj['active']+"</td><td>"+obj['location']+"</td><td><form method='post' action='admin_fetch.php'><input type='hidden' name='hid' value='"+obj['JobId']+"'><input type='submit' name='active' value='active'></form></td></tr>");


                   }
               }
               else     $('#details').append("<h2>No inactive Jobs</h2>");


                  }
                              }
});

	}



function waiting(){
			    $('#waiting').css("background", "blue");

		jQuery.ajax({
    type: "POST",
    url: 'admin_fetch.php',
    data: {functionname: 'waiting'},
    error: function(obj,textstatus){
      alert(textstatus);
    },

    success: function (data, textstatus) {

                  if( data ) {
                  		$('#details').empty();
                  		 var dataArray = JSON.parse(data);
                  		if(dataArray.length>0){
                  		$('#details').append("<table><tr><th>Job_id</th><th>Name</th><th>Description</th><th>Category</th><th>MaxPrice</th><th>MinPrice</th><th>Employer</th><th>Date</th><th>active</th><th>location</th></tr>");
                   for(i=0;i<dataArray.length;i++){
                   	             var obj = dataArray[i];
                   	 $('#details').append("<tr><td>"+obj['JobId']+"</td><td>"+obj['JobName']+"</td><td>"+obj['JobDescription']+"</td><td>"+obj['CategoryName']+"</td><td>"+obj['MaxPrice']+"</td><td>"+obj['MinPrice']+"</td><td>"+obj['userName']+"</td><td>"+obj['Date']+"</td><td>"+obj['active']+"</td><td>"+obj['location']+"</td></tr>");


                   }
               }
               else     $('#details').append("<h2>No waiting Jobs</h2>");


                  }
                              }
});

	}

function active(){
			    $('#active').css("background", "blue");

		jQuery.ajax({
    type: "POST",
    url: 'admin_fetch.php',
    data: {functionname: 'active'},
    error: function(obj,textstatus){
      alert(textstatus);
    },

    success: function (data, textstatus) {

                  if( data ) {
                  		$('#details').empty();
                  		 var dataArray = JSON.parse(data);
              			var re = JSON.parse('<?php echo $users;?>');
              			console.log(re);
                  		if(dataArray.length!=0){
                  		$('#details').append("<table><tr><th>Job_id</th><th>Name</th><th>Description</th><th>Category</th><th>MaxPrice</th><th>MinPrice</th><th>Employer</th><th>Employee</th><th>Date</th><th>active</th><th>location</th></tr>");
                   for(i=0;i<dataArray.length;i++){
                   	             var obj = dataArray[i];
                   	             var employee=obj['EmployeeId'];
                   	             for(j=0;j<re.length;j++)
                   	             	if(re[j]['userId']==employee)
                   	             		emp=re[j]['userName'];

              			console.log(emp);
                   	 $('#details').append("<tr><td>"+obj['JobId']+"</td><td>"+obj['JobName']+"</td><td>"+obj['JobDescription']+"</td><td>"+obj['CategoryName']+"</td><td>"+obj['MaxPrice']+"</td><td>"+obj['MinPrice']+"</td><td>"+obj['userName']+"</td><td>"+emp+"</td><td>"+obj['Date']+"</td><td>"+obj['active']+"</td><td>"+obj['location']+"</td></tr>");


                   }
               }
               else     $('#details').append("<h2>No active Jobs</h2>");


                  }
                              }
});

	}

function completed(){
			    $('#completed').css("background", "blue");

		jQuery.ajax({
    type: "POST",
    url: 'admin_fetch.php',
    data: {functionname: 'complete'},
    error: function(obj,textstatus){
      alert(textstatus);
    },

    success: function (data, textstatus) {
if( data ) {
                  		$('#details').empty();
                  		 var dataArray = JSON.parse(data);
              			var re = JSON.parse('<?php echo $users;?>');
              			console.log(re);
                  		if(dataArray.length!=0){
                  		$('#details').append("<table><tr><th>Job_id</th><th>Name</th><th>Description</th><th>Category</th><th>MaxPrice</th><th>MinPrice</th><th>Employer</th><th>Employee</th><th>Date</th><th>active</th><th>location</th></tr>");
                   for(i=0;i<dataArray.length;i++){
                   	             var obj = dataArray[i];
                   	             var employee=obj['EmployeeId'];
                   	             for(j=0;j<re.length;j++)
                   	             	if(re[j]['userId']==employee)
                   	             		emp=re[j]['userName'];

              			console.log(emp);
                   	 $('#details').append("<tr><td>"+obj['JobId']+"</td><td>"+obj['JobName']+"</td><td>"+obj['JobDescription']+"</td><td>"+obj['CategoryName']+"</td><td>"+obj['MaxPrice']+"</td><td>"+obj['MinPrice']+"</td><td>"+obj['userName']+"</td><td>"+emp+"</td><td>"+obj['Date']+"</td><td>"+obj['active']+"</td><td>"+obj['location']+"</td></tr>");


                   }
               }
               else     $('#details').append("<h2>No Completed Jobs</h2>");


                  }
                              }
});

	}
	function donepuser(){
		    $('#donepuser').css("background", "blue");
		jQuery.ajax({
    type: "POST",
    url: 'admin_fetch.php',
    data: {functionname: 'donepuser'},
    error: function(obj,textstatus){
      alert(textstatus);
    },

    success: function (data, textstatus) {

                  if( data ) {
                  		$('#details').empty();
                  		 var dataArray = JSON.parse(data);
                  		if(dataArray.length>0){
                  		$('#details').append("<table><tr><th>Name</th><th>Jobs_done</th></tr>");
                   for(i=0;i<dataArray.length;i++){
                   	             var obj = dataArray[i];
                   	 $('#details').append("<tr><td>"+obj['userName']+"</td><td>"+obj['total']+"</td></tr>");


                   }
               }
               else     $('#details').append("<h2>No Jobs done</h2>");


                  }
                              }
});

	}


	function postpuser(){
		    $('#postpuser').css("background", "blue");
		jQuery.ajax({
    type: "POST",
    url: 'admin_fetch.php',
    data: {functionname: 'postpuser'},
    error: function(obj,textstatus){
      alert(textstatus);
    },

    success: function (data, textstatus) {

                  if( data ) {
                  		$('#details').empty();
                  		 var dataArray = JSON.parse(data);
                  		if(dataArray.length>0){
                  		$('#details').append("<table><tr><th>Name</th><th>Jobs_posted</th></tr>");
                   for(i=0;i<dataArray.length;i++){
                   	             var obj = dataArray[i];
                   	 $('#details').append("<tr><td>"+obj['userName']+"</td><td>"+obj['total']+"</td></tr>");


                   }
               }
               else     $('#details').append("<h2>No Jobs Posted</h2>");


                  }
                              }
});

	}

		function category(){
		    $('#category').css("background", "blue");
		jQuery.ajax({
    type: "POST",
    url: 'admin_fetch.php',
    data: {functionname: 'category'},
    error: function(obj,textstatus){
      alert(textstatus);
    },

    success: function (data, textstatus) {

                  if( data ) {
                  		$('#details').empty();
                  		 var dataArray = JSON.parse(data);
                  		if(dataArray.length>0){
                  		$('#details').append("<table><tr><th>Category</th><th>Jobs_posted</th></tr>");
                   for(i=0;i<dataArray.length;i++){
                   	             var obj = dataArray[i];
                   	 $('#details').append("<tr><td>"+obj['CategoryName']+"</td><td>"+obj['total']+"</td></tr>");


                   }
               }
               else     $('#details').append("<h2>No Jobs Posted</h2>");


                  }
                              }
});

	}


      function rating(){
        $('#rating').css("background", "blue");
    jQuery.ajax({
    type: "POST",
    url: 'admin_fetch.php',
    data: {functionname: 'rating'},
    error: function(obj,textstatus){
      alert(textstatus);
    },

    success: function (data, textstatus) {

                  if( data ) {
                      $('#details').empty();
                       var dataArray = JSON.parse(data);
                      if(dataArray.length>0){
                      $('#details').append("<table><tr><th>UserName</th><th>Rating</th></tr>");
                   for(i=0;i<dataArray.length;i++){
                                 var obj = dataArray[i];
                     $('#details').append("<tr><td>"+obj['userName']+"</td><td>"+obj['userRating']+"</td></tr>");


                   }
               }
               else     $('#details').append("<h2>No Jobs Posted</h2>");


                  }
                              }
});

  }


</script>
<div class="container">
<div class="col-md-3 col-sm-4 col-xs-6" onclick="inactive()" >

				
					<div class="card" style="height: 80px" id="inactive">

					<h2 ><center>Inactive <br>Jobs</center></h2>
						
					</div>

					
		</div>
<div class="col-md-3 col-sm-4 col-xs-6" onclick="waiting()" >

				
					<div class="card" style="height: 80px" id="waiting">

					<h2 align="center">Waiting <br>Jobs</h2>
						
					</div>

					
		</div>
		<div class="col-md-3 col-sm-4 col-xs-6" onclick="active()" >

				
					<div class="card" style="height: 80px" id="active">

					<h2 align="center">Active <br> Jobs</h2>
						
					</div>

					
		</div>
		<div class="col-md-3 col-sm-4 col-xs-6" onclick="completed()" >

				
					<div class="card" style="height: 80px" id="completed">

					<h2 align="center">Completed <br>Jobs</h2>
						
					</div>

					
		</div>


<div class="col-md-3 col-sm-4 col-xs-6" onclick="donepuser()" >

				
					<div class="card" style="height: 80px" id="donepuser">

					<h2 align="center"> Jobs Done  <br> Per User</h2>
						
					</div>

					
		</div>

		<div class="col-md-3 col-sm-4 col-xs-6" onclick="postpuser()" >

				
					<div class="card" style="height: 80px" id="postpuser">

					<h2 align="center">Jobs Posted <br> Per User</h2>
						
					</div>

					
		</div>
		<div class="col-md-3 col-sm-4 col-xs-6" onclick="category()">

				
					<div class="card" style="height: 80px" id="category">

					<h2 align="center">Categorywise  <br>  Jobs</h2>
						
					</div>

					
		</div>
    <div class="col-md-3 col-sm-4 col-xs-6" onclick="rating()">

        
          <div class="card" style="height: 80px" id="rating">

          <h2 align="center">Ratings of <br>  Users</h2>
            
          </div>

          
    </div>


</div>
<br><br>
<br>
<div><center>
<div id="details">

</div>
</center>
</div>

<?php include 'footer.php'; ?>
