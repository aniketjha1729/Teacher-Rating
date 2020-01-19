<?php
require_once('allfunction.php');
$link=connect();
session_start();
if(isset($_SESSION['email']))
{
	$email=$_SESSION['email'];
}
else
{
	$_SESSION['errmsg']="Not a valid User.Please Login!";
	header('location: index.php');
}
$f=mysql_query("select * from students where email='$email'");
$m=mysql_fetch_array($f);
$name=$m['name'];
$college=$m['college'];
$msg2="";
if(isset($_POST['name'])==true)
{
	global $msg2;
	$t=$_POST['name'];
$q=mysql_query("select * from teachers where tname='$t'");
$r=mysql_num_rows($q);
if($r==0)
{
$msg2="<button type=button class='btn btn-danger'>No teacher with this id exists. You will be riderected to home page</button>";	
header( 'location:userhome.php');
}
else{
$q=mysql_query("select tid from teachers where tname='$t'");
$r=mysql_fetch_array($q);
$id=$r[0];
$p=mysql_query("select * from teachers where tid='$id'");
$s=mysql_fetch_array($p);
$tname=$s['tname'];
$tdepart=$s['tdepart'];
$tcollege=$s['tcollege'];
$college=$s['tcollege'];
$query="SELECT AVG(utrating) AS avgrate FROM ratings where tid='$id'";
$result=mysql_query($query,$link);
$row=mysql_fetch_array($result);
if($row[0]==null)
{
	$uavg="No Ratings Yet";
}
else
{
	$uavg=number_format((float)$row[0],1,'.','');
}
$query="SELECT AVG(trating) AS avgrate FROM ratings where tid='$id'";
$result=mysql_query($query,$link);
$row=mysql_fetch_array($result);
if($row[0]==null)
{
	$avg="No Ratings Yet";
}
else
{
	$avg=number_format((float)$row[0],1,'.','');
}
$query="select AVG(simtrating) AS avgrate from ratings where tid='$id'";
$result=mysql_query($query,$link);
$row=mysql_fetch_array($result);
if($row[0]==null)
{
	$savg="No Ratings Yet";
}
else
{
	$savg=number_format((float)$row[0],1,'.','');
}
$query="select AVG(cleartrating) AS avgrate from ratings where tid='$id'";
$result=mysql_query($query,$link);
$row=mysql_fetch_array($result);
if($row[0]==null)
{
	$cavg="No Ratings Yet";
}
else
{
	$cavg=number_format((float)$row[0],1,'.','');
}
$query="select AVG(supportrating) AS avgrate from ratings where tid='$id'";
$result=mysql_query($query,$link);
$row=mysql_fetch_array($result);
if($row[0]==null)
{
	$suavg="No Ratings Yet";
}
else
{
	$suavg=number_format((float)$row[0],1,'.','');
}

}
}
else{
$id=$_POST['id'];
$id = intval(preg_replace('/[^0-9]+/', '', $id), 10);
global $msg2;
$q=mysql_query("select * from teachers where tid='$id'");
$r=mysql_num_rows($q);
if($r==0)
{
$msg2="<button type=button class='btn btn-danger'>No teacher with this id exists. You will be riderected to home page</button>";	
header( "Refresh:5; url=userhome.php", true, 303);
}
else
{
$q=mysql_query("select * from teachers where tid='$id'");
$r=mysql_fetch_array($q);
$tname=$r['tname'];
$tdepart=$r['tdepart'];
$college=$r['tcollege'];
$tcollege=$r['tcollege'];
$query="SELECT AVG(trating) AS avgrate FROM ratings where tid='$id'";
$result=mysql_query($query,$link);
$row=mysql_fetch_array($result);
if($row[0]==null)
{
	$avg="No Ratings Yet";
}
else
{
	$avg=number_format((float)$row[0],1,'.','');
}
$query="SELECT AVG(utrating) AS avgrate FROM ratings where tid='$id'";
$result=mysql_query($query,$link);
$row=mysql_fetch_array($result);
if($row[0]==null)
{
	$uavg="No Ratings Yet";
}
else
{
	$uavg=number_format((float)$row[0],1,'.','');
}
$query="select AVG(simtrating) AS avgrate from ratings where tid='$id'";
$result=mysql_query($query,$link);
$row=mysql_fetch_array($result);
if($row[0]==null)
{
	$savg="No Ratings Yet";
}
else
{
	$savg=number_format((float)$row[0],1,'.','');
}
$query="select AVG(cleartrating) AS avgrate from ratings where tid='$id'";
$result=mysql_query($query,$link);
$row=mysql_fetch_array($result);
if($row[0]==null)
{
	$cavg="No Ratings Yet";
}
else
{
	$cavg=number_format((float)$row[0],1,'.','');
}
$query="select AVG(supportrating) AS avgrate from ratings where tid='$id'";
$result=mysql_query($query,$link);
$row=mysql_fetch_array($result);
if($row[0]==null)
{
	$suavg="No Ratings Yet";
}
else
{
	$suavg=number_format((float)$row[0],1,'.','');
}
}
}
disconnect($link);
?>
<html>
<head>
<?php
require_once 'head.php';
?>

</head>
<body>
<?php
require_once 'templateuser.php'; 
?>
<div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
         <ul class="nav nav-sidebar"></ul>
          <ul class="nav nav-sidebar"></ul>
          <ul class="nav nav-sidebar">
            <ul class="nav nav-sidebar">
            <li class="active"><a href="#">HELLO <?php echo $name;?> <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Change Password</a></li>
            <li><a href="#">Update Profile</a></li>
            <li><a href="#">Manage Ratings</a></li>
          </ul>
          <ul class="nav nav-sidebar"></ul>
          <ul class="nav nav-sidebar"></ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"></h1>

		  <?php echo $msg2;?>
		  <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="<?php if(file_exists("images/image_".$id.".jpg")){echo "images/image_".$id.".jpg";}else{echo "images/default.png";};?>" class="img-responsive" alt="">
              <h4><?php echo $tname;?></h4>
              <span class="text-muted"><?php echo strtoupper($tcollege);?></span>
            </div>
            
			
		  <h2 class="sub-header">Rating of <?php echo $tname;?></h2>
       <h3>Total Ratings &nbsp; <?php echo $avg;?></h3>
		
		   <div class="table-responsive">
            <table class="table table-striped">
              <thead>
			   <tr>
                  <th>Simple Teaching</th>
                  <th>Clears Concept</th>
                  <th>Supportiveness</th>
				  <th>Uses Understandable Language</th>
                  <th>Total Ratings</th>
				  <th>Number of Ratings</th>
                  
                </tr>
           </thead>
		   <tbody>
		<tr><td><button type="button" class="btn btn-info"><?php echo $savg;?></button>/10</td><td><button type="button" class="btn btn-info"><?php echo $cavg;?></button>/10</td> <td><button type="button" class="btn btn-info"><?php echo $suavg;?></button>/10<td><button type="button" class="btn btn-info"><?php echo $uavg;?></button>/10</td><td><button type="button" class="btn btn-info"><?php echo $avg;?></button>/10</td><td><span class='badge'><?php 
$link=connect();
global $id;
$query="select * from ratings where tid='$id'";
$result=mysql_query($query,$link);
$num=mysql_num_rows($result);
if($num==0)
{
	echo "Be the first To Rate";
}
else{
echo $num;
}
disconnect($link);
 ?></span></td>
		</tr>
		
		
		<div class="table-responsive">
            <table class="table table-striped">
              <thead>
			   <tr>
                  <th>Recent Reviews</th>
                  
                </tr>
           </thead>
		   <tbody>
		<?php
$link=connect();
$name="";
$query2="select * from ratings where tid='$id'";
$result2=mysql_query($query2,$link);
while($row=mysql_fetch_array($result2))
{ 
	if(!empty($row['treview']))
	{	
		if($row['ia']==1)
			{
			$name="Annonymous Comment";
			}
		elseif($row['ia']==0)
		{   
		$query=mysql_query("select * from students where sid=".$row['sid']."");
		$rqw=mysql_fetch_array($query);
		$name=$rqw['name']." - wrote -";
		}
         echo "<tr><td class='col-md-2 info' colspan=2>".$name."</td></tr><tr><td class='col-md-1'></td><td class='col-md-8 warning'>".htmlspecialchars($row['treview'], ENT_QUOTES, 'UTF-8')."</td></tr>";
	}
    else
	{
		echo "<tr><td class='col-md-2 info' colspan=2> No Comments Yet</td></tr>";
	}
}
 
disconnect($link);
   ?>
              </tbody>
            </table>
          </div>
		  
		  
		  		<div class="table-responsive">
            <table class="table table-striped">
              <thead>
			  <th>Now Its Your Turn</th>
           </thead>
		   <tbody>
		<tr>
		</tr>
		<tr><td><form method="POST" action="userrating.php">
<input type=hidden name=id value="<?php echo $id;?>">
 <input class="btn btn-primary btn-lg" type=submit value="Rate Now">
 
 </form></td>
		</tr>
              </tbody>
            </table>
          </div>
		
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
          </div>
<?php
require_once 'footer.php';
 ?>
</body>
</html>