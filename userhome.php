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
$college=strtoupper($row['college']);
$dept=strtoupper($row['dept']);
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
        <div class="col-sm-3 col-md-2 sidebar hidden-md-down">
         <ul class="nav nav-sidebar"></ul>
          <ul class="nav nav-sidebar"></ul>
          <ul class="nav nav-sidebar">
            <ul class="nav nav-sidebar">
            <li class="active"><a href="#">HELLO <?php echo $name;?> <span class="sr-only">(current)</span></a></li>
            <li><a href="userpwdchange.php">Change Password</a></li>
            <li><a href="updateuser.php">Update Profile</a></li>
            <li><a href="managerating.php">Manage Ratings</a></li>
          </ul>
          <ul class="nav nav-sidebar"></ul>
          <ul class="nav nav-sidebar"></ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="col-lg-6 col-lg-offset-3">
    <form method="POST" action="teacherrating.php">
    <div class="input-group searchbox" style="position: absolute; top: 10%;">
      <input type="text" class="form-control"   name="name" id="search_box" required autocomplete="off" autofocus placeholder="Search for any guru of your college..">
      <br>
      <div id="searchres" class="searchres"></div>
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit">Go!</button>
      </span>
      
    </div><!-- /input-group -->
</form>
    </div>
    <br><br>
		  <h2>TEACHERS OF YOUR DEPARTMENT</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
			   <tr>
                  <th></th>
                  <th>Teacher Name</th>
                  <th>Qualification</th>
                  <th>Position</th>
                </tr>
           </thead>
		   <?php 
$teachertable="";
$avg="";
		If($teacherarray==null)
{
	echo "<tr><td colspan=11>"."No teacher of your college or branch is available in our database. You can add teacher of your college and department <a href=addteacher.php>here</a>"."</tr>";	
}
else 
{
 foreach ($teacherarray as $value)
{
$teachertable= "<tr><td><img src=images/image_$value[0].jpg onerror=(this.src='images/default.png') style='width: 150px;height: 120px;' class='img-rounded'></img> </td><td> ".strtoupper($value[1])."</td><td>".$value[4]."</td><td> ".$value[5]."</td><td></td><td><form name=f'".$value[0]."' method=POST action=teacherrating.php><input type=hidden name=id value=".$value[0]."><input class='btn btn-primary btn-md' type=submit value='Rate The Guru'></button></form></td></tr>";
echo $teachertable;
}
echo "<tr><td colspan=8>If You want to add more teachers, you can do it too. Just click <a href=addteacher.php>here</a></td></tr>";
}
?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <?php require_once 'footer.php';?>
 </body>
</html>

    