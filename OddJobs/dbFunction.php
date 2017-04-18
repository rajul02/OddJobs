<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

	class dbFunction
	{
		//FOR CONNECTION
		public function __construct($conn)
		{
			//conecting to database
			$this->db = $conn;
		}

public function admin($password,$email){
			if($password=="correct" && $email=="politically"){
				return true;

			}
			return false;

		}


		public function inactive(){
			$query="SELECT * FROM jobdetail , category,usertable WHERE active=0 and JobCategory=CategoryId and userId=EmployerId";
			$q = mysqli_query($this->db,$query);
			if(!$q){
				return mysqli_error($this->db);
			}
			return $q;


		}

		public function makeActive($id){
			$query="UPDATE jobdetail SET active=1 WHERE JobId='$id' ";
			$q=$this->db->query($query);
			print_r($q);
			return $q;



		}
				public function waiting(){
			$query="SELECT * FROM jobdetail , category,usertable WHERE active=1 and status='waiting' and JobCategory=CategoryId and userId=EmployerId";
			$q = mysqli_query($this->db,$query);
			if(!$q){
				return mysqli_error($this->db);
			}
			return $q;


		}
		public function active(){
			$query="SELECT * FROM jobdetail , category,usertable WHERE active=1 and status='assigned' and JobCategory=CategoryId and userId=EmployerId";
			$q = mysqli_query($this->db,$query);
			if(!$q){
				return mysqli_error($this->db);
			}
			return $q;


		}

		public function complete(){
			$query="SELECT * FROM jobdetail , category,usertable WHERE active=1 and status='completed' and JobCategory=CategoryId and userId=EmployerId";
			$q = mysqli_query($this->db,$query);
			if(!$q){
				return mysqli_error($this->db);
			}
			return $q;


		}
		

		public function getAllUser(){
			$query="SELECT userId, userName FROM usertable ";

			$q = mysqli_query($this->db,$query);
			if(!$q){
				return mysqli_error($this->db);
			}
			return $q;

		}

		public function getRating(){
			$query="SELECT userName, userRating FROM usertable ";

			$q = mysqli_query($this->db,$query);
			if(!$q){
				return mysqli_error($this->db);
			}
			return $q;

		}
		
		public function done_per_user(){
						$query="SELECT count(JobId) as total,userName FROM `jobdetail`,usertable WHERE EmployeeId=userId GROUP BY userName ";

			$q = mysqli_query($this->db,$query);
			if(!$q){
				return mysqli_error($this->db);
			}
			return $q;

		}
		public function post_per_user(){
						$query="SELECT count(JobId) as total,userName FROM `jobdetail`,usertable WHERE EmployerId=userId GROUP BY userName ";

			$q = mysqli_query($this->db,$query);
			if(!$q){
				return mysqli_error($this->db);
			}
			return $q;

		}
		public function category(){
						$query="SELECT count(JobId) as total,CategoryName FROM `jobdetail`,category WHERE JobCategory=CategoryId GROUP BY CategoryName ";

			$q = mysqli_query($this->db,$query);
			if(!$q){
				return mysqli_error($this->db);
			}
			return $q;

		}

		public function Login($password,$email)
		{
			
				$res = mysqli_query($this->db, "SELECT * FROM usertable WHERE email='$email' and password='$password'");
			if (!$res) {
	    		echo 'Could not run query: ' . mysqli_error();
	    		exit;
			}	
			$no_rows = mysqli_num_rows($res);
			$user_data=mysqli_fetch_assoc($res);

			if($user_data["userId"])

			{	
							$_SESSION['userId'] = $user_data["userId"];
				//$_SESSION['username'] = $user_data["username"];
				//header("Location: blogger.php");
				//echo $user_data["username"];
				return $user_data["userId"];
			}
			else
			{
				return false;
			}


			
			
		}

		public function Registertw($password,$username)
		{
			
			//$d = date_create()->format('Y-m-d');
		
			
			//mysqli_query($this->db, "INSERT INTO `userdetails`(  `password`,  `email`) VALUES ('$password','$email')");
			$query = "INSERT INTO `usertable`(  `password`,  `username`) VALUES ('$password','$username')";
			$q = mysqli_query($this->db,$query);
			if(!$q){
				echo mysqli_error($this->db);
				return false;
			}
			session_start();
			    $last_id =$this->db->insert_id;
			$_SESSION['userId']=$last_id;

			return true;


			
			
		}




		public function Register($password,$email)
		{
			
			//$d = date_create()->format('Y-m-d');
		
			$password = $password;
			//mysqli_query($this->db, "INSERT INTO `userdetails`(  `password`,  `email`) VALUES ('$password','$email')");
			$query = "INSERT INTO `usertable`(  `password`,  `email`) VALUES ('$password','$email')";
			$q = mysqli_query($this->db,$query);
			if(!$q){
				echo mysqli_error($this->db);
				return false;
			}
			 if(!isset($_SESSION)) 
			  { 
			      session_start(); 
			  } 
			$last_id =$this->db->insert_id;
			print_r($last_id);
			$_SESSION['userId']=$last_id;

			return true;


			
			
		}

		public function addJob($jobname,$desc,$cat,$minprice,$maxprice,$location,$userid){
			$query = "INSERT INTO `jobdetail`(`JobId`, `JobName`, `JobDescription`, `JobCategory`, `MaxPrice`, `MinPrice`, `Date`, `EmployerId`, `EmployeeId`, `active`, `status`, `location`) VALUES ('','$jobname','$desc','$cat','$maxprice','$minprice','now()','$userid','','0','waiting','$location')";

			$q=$this->db->query($query);
			if($q){
				echo "Successfully Uploaded";
			}

		}

		public function getJobByUserId($userId){
			$query="select * from jobdetail,category where EmployerId = '$userId' and CategoryId = JobCategory";
			$q=$this->db->query($query);
		//	print_r($query);
			$data = array();
			if($q){
				while($row = mysqli_fetch_assoc($q)){
					//print_r($row);
					array_push($data,$row);
						//$data = array_push($data,$row);
				}
			}
			
			//print_r($data);
			return $data;
		}

		public function getAllJobs(){
			$query="select * from jobdetail,category where CategoryId = JobCategory and active = 1";
			$q=$this->db->query($query);
		//	print_r($query);
			$data = array();
			if($q){
				while($row = mysqli_fetch_assoc($q)){
					//print_r($row);
					array_push($data,$row);
						//$data = array_push($data,$row);
				}
			}
			
			//print_r($data);
			return $data;
		}


		public function getAllCatgories()
		{
			$query="select * from category";
			$q=$this->db->query($query);
			$data = array();
			while($row = mysqli_fetch_assoc($q)){
				//print_r($row);
				array_push($data,$row);
					//$data = array_push($data,$row);
			}
			
			//print_r($data);
			return $data;
		}

		public function UpdateUser($id,$name,$email,$phone){
			$query="UPDATE usertable SET username='$name', prefferedCategory='$phone' ,email='$email' WHERE userId='$id' ";
			$q=$this->db->query($query);
			return $q;


		}

		public function getJobsByEmployeId($id){
			$query="select * from jobdetail,category where EmployeeId = '$id' and CategoryId = JobCategory";
			$q=$this->db->query($query);
		//	print_r($query);
			$data = array();
			if($q){
				while($row = mysqli_fetch_assoc($q)){
					//print_r($row);
					array_push($data,$row);
						//$data = array_push($data,$row);
				}
			}
			
			//print_r($data);
			return $data;
		}




		public function ChangePassword($id,$password){
			$query="UPDATE usertable SET password='$password' WHERE userId='$id' ";
			$q=$this->db->query($query);
			print_r($q);
			return $q;


		}




		public function Logout()
		{
			session_destroy();
			header("Location: index.php");
		}
		

		public function userCheck($name){
			$query = "SELECT `userId` FROM `usertable` WHERE username LIKE '$name' OR email Like '$name'";
			//print_r($query);
			$result = mysqli_query($this->db,$query);
			//print_r($result);
			$user_data=mysqli_fetch_assoc($result);
			//print_r($user_data);
			if(isset($_SESSION['userId'])){
			session_start();
			$_SESSION['userId']=$user_data['userId'];
			}
			return $user_data['userId'];
		}

		public function getUserDetail($uid)
		{
			$query = "select * from usertable where userId = $uid limit 1";

			$result = mysqli_query($this->db,$query);
	//		echo mysqli_error($this->db);
	
			if($result) {
				$data = mysqli_fetch_assoc($result);
				return $data;
			}
			else {
				return [];
			}
		}

		public function getNotification($id){
			$query = "SELECT * FROM `jobnotifications` WHERE Userid = '$id'";

			$q=$this->db->query($query);
		//	print_r($query);
			$data = array();
			while($row = mysqli_fetch_assoc($q)){
				//print_r($row);
				array_push($data,$row);
					//$data = array_push($data,$row);
			}
			
			//print_r($data);
			return $data;
		}


		public function rateEmploye($jobId, $rateValue){

			$query = "SELECT `EmployeeId` FROM `jobdetail` WHERE JobId = $jobId";
			$q=$this->db->query($query);
			$data = array();
			while($row = mysqli_fetch_assoc($q)){
				
				array_push($data,$row);
				
					
			}
			print_r($data[0]['EmployeeId']);
			$id = $data[0]['EmployeeId'];
			$query = "SELECT `userRating` FROM `usertable` WHERE userId =$id";
			$q=$this->db->query($query);
			$data = array();
			while($row = mysqli_fetch_assoc($q)){
				
				array_push($data,$row);
				
					
			}
			print_r($data[0]['userRating']);
			$rate = $data[0]['userRating'];
			$r = ($rate+$rateValue)/2;
			print_r($r);
			$query = "UPDATE `usertable` SET userRating=$r WHERE userId = $id";
			print_r($query);
			$res = mysqli_query($this->db,$query);
			print_r($res);
			if($res){
				return true;
			}
		}

		public function ApplyJob($jobId,$applicantId,$EmployerId)
		{
			$query ="INSERT INTO `jobapplications`(`ApplicationId`, `JobId`, `ApplicantId`) VALUES ('','$jobId','$applicantId')";
			
			$res = mysqli_query($this->db,$query);
			if($res){
				$query = "INSERT INTO `jobnotifications`(`Id`, `UserId`, `JobId`, `message`, `SeenStatus`) VALUES ('','$EmployerId','$jobId','Your job is taken.','0')";


				$res = mysqli_query($this->db,$query);

				$query = "UPDATE `jobdetail` SET `EmployeeId`=$applicantId,`status`='assigned' WHERE JobId = $jobId";
				$res = mysqli_query($this->db,$query);
				return true;
			}
		} 

		public function NotificationClick($id)
		{
			$query = "UPDATE `jobnotifications` SET `SeenStatus`=1 WHERE Id = '$id'";

			$res = mysqli_query($this->db,$query);
			print_r($res);
			if($res){
				return true;
			}
		}

		public function CompleteJob($jobId, $EmployerId)
		{
			    $query = "INSERT INTO `jobnotifications`(`Id`, `UserId`, `JobId`, `message`, `SeenStatus`) VALUES ('','$EmployerId','$jobId','Your job is completed.','0')";


				$res = mysqli_query($this->db,$query);
				print_r($query);

				$query = "UPDATE `jobdetail` SET `status`='completed' WHERE JobId = $jobId";
				$res = mysqli_query($this->db,$query);
				if($res){
					return true;
				}
			
		}

		
		public function search_jobs($filter,$filterby,$search){

			$query = "";
			if($filter==""){
				if($search==""){
					$query="SELECT * FROM `jobdetail`, category where CategoryId=JobCategory and active = 1 and status='waiting'";					
				}else{
					$query = "select * from jobdetail,category where CategoryId=JobCategory and active = 1 and status='waiting' and  (JobName LIKE '%$search%' or JobDescription LIKE '%$search%')";
				}
			}
			else{
				
				if($filterby=='location'){
					$query="select * from jobdetail , category where CategoryId=JobCategory and active = 1 and status='waiting' and location = '$filter'";
						if($search!=""){
							$query.= " and (JobName LIKE '%$search%' or JobDescription LIKE '%$search%')";
						}
				}else if($filterby=='price'){
						$range=explode('-', $filter);
						$min=$range[0];
						$max=$range[1];
					//	print_r($min." ".$max);
						$query="select * from jobdetail, category where CategoryId=JobCategory and active = 1 and status='waiting' and ((minprice >= $min and minprice <= $max) or (maxprice <= $max and maxprice >= $min))";
						if($search!=""){
								$query.= " and (JobName LIKE '%$search%' or JobDescription LIKE '%$search%')";
						}
				}else if($filterby == 'category'){
							//print_r($filter);
							$query="select * from jobdetail, category where CategoryId=JobCategory and active = 1 and status='waiting' and JobCategory = $filter ";
							if($search!=""){
								$query.= " and (JobName LIKE '%$search%' or JobDescription LIKE '%$search%')";
							}
						}	
				
					
			}
			//print_r($query);
			//echo("<br><br>");
			$result = $this->db->query($query);
			//print_r($result);
			return $result;



		}



	}

		
?>