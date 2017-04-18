<?php include 'header.php';?>

<?php

 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

include_once "dbConnect.php";
include_once "dbFunction.php";
$funobj = new dbFunction($conn);
$catdata = $funobj->getAllCatgories();


  if(isset($_POST['submit'])) {
    $jobname = $_POST['jobname'];
    $desc = $_POST['desc'];
   
    $cat = $_POST['category'];
    $minprice = $_POST['min_price'];
    $maxprice = $_POST['max_price'];
    $location = $_POST['location'];
    if(isset($_SESSION["userId"])){
      //echo($jobname."<br>".$desc."<br>".$cat."<br>".$minprice."<br>".$maxprice."<br>".$location);
      $funobj->addJob($jobname,$desc,$cat,$minprice,$maxprice,$location,$_SESSION["userId"]);
    }
    

    //echo $title."<br>".$desc;
  }

?>

<div class="container">
  <form class="form-horizontal" action="" method="post" enctype="multipart/form-data" style="width:600px">
    <div class="form-group">
      <label class="col-sm-2 control-label">Job Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="jobname"  placeholder="Job Name" >
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">Category</label>
      <div class="col-sm-10">
        <select id="selectFilter" name="category" class="selectpicker" title="Select Filter...">
            <?php foreach($catdata as $val): ?>
              <option value="<?php echo($val['CategoryId']);?>"><?php echo($val['CategoryName']);?></option>
            <?php endforeach; ?>
            
          </select>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">Job Description</label>
      <div class="col-sm-10">
        <textarea rows="6" class="form-control" name="desc"  placeholder="Job Description" ></textarea>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">Minimum Price ₹:</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" name="min_price"  placeholder="Minimum Price" >
      </div>
    </div>

     <div class="form-group">
      <label class="col-sm-2 control-label">Maximum Price ₹:</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" name="max_price"  placeholder="Maximum Price" >
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">Location</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="location"  placeholder="Location" >
      </div>
    </div>
    
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="submit" value="submit" class="btn btn-default">Upload Job</button>
      </div>
    </div>
  </form>
</div>
  
<?php include 'footer.php'; ?>

