<?php
require_once 'allfunction.php';
session_start();

if(isset($_SESSION['email']))
{
	$email=$_SESSION['email'];
}
else
{
	$_SESSION['errmsg']="Not a valid User.Please Login!";
	header('location: index.php');
	//return;
}
?>
<?php
$link=connect();
$q=mysql_query("select * from students where email='$email'");
$r=mysql_fetch_array($q);
$name=$r['name'];
$college=$r['college'];
$tcollege=$r['college'];
$tdepart=$r['dept'];
$msg="";
if(isset($_GET['submit']))
{   

    global $tcollege,$tcollege,$tdepart;
	$tname=$_GET['teachername'];
	$tqual=$_GET['qualification'];
	$tstate=$_GET['position'];
	$q1=mysql_query("select max(tid)+1 from temp_teachers");
	$r1=mysql_fetch_array($q1);
	$tid=$r1{0};
	$q=mysql_query("insert into temp_teachers (tid,tname,tqual,tcollege,tdepart,tstate) values ('$tid','$tname','$tqual','$tcollege','$tdepart','$tstate')");
	$msg="<button type=button class='btn btn-success'>Teacher Added successfully. We will review, and update our database soon.</button>";
    }	
disconnect($link);
?>

<html>
<head><title></title>
<?php require_once 'head.php';?>
</head>
<body>
<?php include 'templateuser.php';?>
 
 <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
      <ul class="nav nav-sidebar"></ul>
          <ul class="nav nav-sidebar"></ul>
          <ul class="nav nav-sidebar">
            <ul class="nav nav-sidebar">
            <li class="active"><a href="#">HELLO <?php echo $name;?> <span class="sr-only">(current)</span></a></li>
            <li><a href="userpwdchange.php">Change Password</a></li>
            <li><a href="userpwdchange.php">Update Profile</a></li>
            <li><a href="managerating.php">Manage Ratings</a></li>
          </ul>
          <ul class="nav nav-sidebar">
         
          </ul>
          <ul class="nav nav-sidebar"></ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"></h1>
		  <?php echo $msg;?>
<div class="container">
  <h2>Add A Teacher of Your College and Your Department</h2>
  <form class="form-horizontal" role="form" name="add" method=get  enctype="multipart/form-data" action="">
    <div class="form-group">
      <label class="control-label col-sm-2" for="teachername">Name Of The Teacher:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" id="teachername" name="teachername" placeholder="Enter Teacher Name" required>
      </div>
    </div>
  
	  <div class="form-group">
      <label class="control-label col-sm-2" for="qualification">Qualification of Teacher:</label>
      <div class="col-sm-6">          
        <input type="text" class="form-control" id="qualification" name="qualification" placeholder="Enter Teacher Qualification" required>
      </div>
    </div>  
	<div class="form-group">
      <label class="control-label col-sm-2" for="position">Teacher Position</label>
      <div class="col-sm-6">          
        <input type="text" class="form-control" id="position" name="position" placeholder="Enter Teacher Position" required>
      </div>
    </div>

   <div class="form-group">
      <label class="control-label col-sm-2" for="image">Upload A Image</label>
      <div class="col-sm-6"> 
<input id="image" name="image" type="file" multiple class="file-loading">
<script>
$(document).on('ready', function() {
    $("#input-4").fileinput({showCaption: false});
});
</script>
      </div>
    </div>
	 <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label><input type="checkbox" required> You confirm That the Details are Correct</label>
        </div>
      </div>
    </div>

	
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default" name="submit">Submit</button>
      </div>
    </div>
  </form>
</div>

		  
		  
		  
		  
		  
		  </div>
        </div>
		</div>
<?php require_once 'footer.php';?>
</body>

</html>
