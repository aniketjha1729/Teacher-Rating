<?php
require_once('allfunction.php');
$link=connect();
$tname="";
if(isset($_GET['name']))
{
$tname=$_GET['name'];
$q=mysql_query("select * from teachers where tname='$tname'");
$r=mysql_num_rows($q);
if($r==0)
{
	header('location:userhome.php');
}
else{
	global $q;
$m=mysql_fetch_array($q);
$tcollege=$m['tcollege'];
$id=$m['tid'];
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
else 
{
	$id=$_GET['id'];
	$id = intval(preg_replace('/[^0-9]+/', '', $id), 10);
	global $msg2;
	$q=mysql_query("select * from teachers where tid='$id'");
	$r=mysql_num_rows($q);
	if($r==0)
	{
		$msg2="<button type=button class='btn btn-danger'>No teacher with this id exists. You will be riderected to home page</button>";
		header('location:index.php');
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
			$uavg=number_format((float)$row[0],1,'.','')."<span class='fa fa-star' style='color:darkorange;'></span>";
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
			$savg=number_format((float)$row[0],1,'.','')."<span class='fa fa-star' style='color:darkorange;'></span>";
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
			$cavg=number_format((float)$row[0],1,'.','')."<span class='fa fa-star' style='color:darkorange;'></span>";
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
			$suavg=number_format((float)$row[0],1,'.','')."<span class='fa fa-star' style='color:darkorange;'></span>";
		}
	}
	}
	disconnect($link);
?>


<html>
<head>
<title>RateYourGuru
</title>
<?php require_once'headhome.php';?>
<link rel="stylesheet" href="css/footer.css">
</head>
<body>
<?php require_once 'templatehome.php';?>
<div class="container">
      <div class="row">
 <div class="hidden-xs col-sm-3 col-md-2 sidenav">
      <div class="well-lg" style="
    padding-left: 0px;
    margin: 0 0 0 -97px;
">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Big Vertical -->
<ins class="adsbygoogle"
     style="display:inline-block;width:300px;height:600px"
     data-ad-client="ca-pub-8403262670102197"
     data-ad-slot="5342149663"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
      </div>
      
      </div>
          <div class="col-sm-9 col-md-10 main">
        
		  <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="<?php if(file_exists("images/image_".$id.".jpg")){echo "images/image_".$id.".jpg";}else{echo "images/default.png";};?>" width="200" height="200" class="img-responsive" alt="">
              <h4><?php echo $tname;?></h4>
              <span class="text-muted"><?php echo strtoupper($tcollege);?></span>
            </div>
            
			
		  <h2 class="sub-header">Rating of <?php echo $tname;?></h2>
           <h3>Total Ratings: <?php echo $avg;?><span class="fa fa-star" style=" color:darkorange;"></span></h3>
		
		   <div class="table-responsive">
            <table class="table table-striped">
              <thead>
			   <tr>
                  <th>Simple Teaching</th>
                  <th>Clears Concept</th>
                  <th>Supportiveness</th>
				  <th>Communications Skills</th>
                  <th>Total Ratings</th>
				  <th>Number of Ratings</th>
                  
                </tr>
           </thead>
		   <tbody>
		<tr><td><div class="alert alert-info"><?php echo $savg;?></div></td><td><div class="alert alert-info"><?php echo $cavg;?></div></td> <td><div class="alert alert-info"><?php echo $suavg;?></div><td><div class="alert alert-info"><?php echo $uavg;?></div></td><td><div class="alert alert-info"><?php echo $avg;?></div></td><td><div class="btn btn-warning"><?php 
$link=connect();
global $tname;
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
 ?></button></td>
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
	<div class="table-responsive">
            <table class="table table-striped">
              <thead>
			   <tr>
                  <th>You Need to Login to Rate your college teachers</th>
                
                </tr>
				<tr>
				<td><form action=login.php> <input class="btn btn-primary btn-danger" type=submit value="Login to Rate"></form></td>
				</tr>
           </thead>     
	 </table>
          </div>
		
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
<br>
<br>
<br>
<?php require_once 'footer.php';?>
</body>
</html>