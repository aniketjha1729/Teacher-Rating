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
require_once('allfunction.php');
$link=connect();
$name="";
$tname="";
$college="";
$tdept="";
$query="select * from students where email='$email'";
$result=mysql_query($query,$link);
$row=mysql_fetch_array($result);
$name=$row['name'];
$college=$row['college'];
$dept=$row['dept'];
$teacherarray=searchteacher($link,$college,$dept);
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
            <li ><a href="userhome.php">HELLO <?php echo $name;?></a></li>
            <li><a href="userpwdchange.php">Change Password</a></li>
            <li class="active"><a href="updateuser.php">Update Profile<span class="sr-only">(current)</span></a></li>
            <li><a href="managerating.php">Manage Ratings</a></li>
          </ul>
          <ul class="nav nav-sidebar"></ul>
          <ul class="nav nav-sidebar"></ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"></h1>
          <form class="form-horizontal" role="form" name="myForm" method="POST" enctype="multipart/form-data" action="">
    <div class="form-group">
      <label class="control-label col-sm-2" for="newpwd" >Enter Your new Password</label>
      <div class="col-sm-6">
        <input type="password" class="form-control" id="newpwd" name="newpwd" id="strength" placeholder="Enter A New Password" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="confirm">Confirm Your New Password:</label>
      <div class="col-sm-6">
        <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Confirm Your Password" required>
      </div>
    </div>
  <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success" name="submit">Submit</button>
      </div>
    </div>
  </form>	
          </div>
          </div>
          </div>
          </body>
          </html>>