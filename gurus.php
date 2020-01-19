<html>
<head>

<?php
require_once 'headhome.php';

?> 
<title>Rate The Tutor</title>
</head>
<body>
<?php require_once 'templatehome.php';?>
<h3><?php 
if(isset($_GET['college']) && $_GET['dept'])
{
	echo "These Are the Gurus of ".strtoupper($_GET['dept'])." in Our records";
}
else {
	echo "No Department Selected and college select go to home";
}
?></h3>
<div class=container>
<div class="table-responsive">
            <table class="table table-hover">
                  <thead>
			   <tr>
                  <th></th>
                  <th>Teacher Name</th>
                  <th>Qualification</th>
                  <th>Position</th>
                </tr>
           </thead>
		   <?php
		   require_once 'allfunction.php';
		   $link=connect();
		   if(isset($_GET['dept']) && isset($_GET['college']))
		   {
		   	$de=$_GET['dept'];
		   $co=$_GET['college'];
		   $collegetable="";
$avg="";
$i="";
$query=mysql_query("select * from teachers where tcollege='$co' and tdepart='$de';");
while($row=mysql_fetch_array($query))
{
		$collegearray[$i]=$row;
		$i++;
}

		If($collegearray==null)
{
	echo "<tr><td colspan=11>"."If your department is not listed, you can contact us and get your department listed</tr>";	
}
else 
{
 foreach ($collegearray as $value)
{
$collegetable="<tr><td><img src=images/image_$value[0].jpg onerror=(this.src='images/default.png') style='width: 150px;height: 120px;' class='img-rounded'></img> </td><td> ".strtoupper($value[1])."</td><td>".$value[4]."</td><td> ".$value[5]."</td><td></td><td><form name=f'".$value[0]."' method=GET action=seeratings.php target=_blank><input type=hidden name=id value=".$value[0]."><input class='btn btn-primary btn-md' type=submit value='SEE The Ratings'></button></form></td></tr>";
echo $collegetable;
}
echo "<tr><td colspan=8>If there's a mistake in above data, or a update is required, do let us know.</td></tr>";
}
		   }
disconnect($link);
?>
              </tbody>
            </table>
          </div>
        </div>
<?php require_once 'footer.php';?>
</body>
</html>