<html>
<head>
<script src="js/npm.js"></script>
<?php
require_once 'headhome.php';
?> 
<title>Rate The Tutor</title>
</head>
<body>
<?php require_once 'templatehome.php';?>
<h3><?php 
if(isset($_GET['college']))
{
	echo "These Are The Departments of ".strtoupper($_GET['college'])." in Our records";
}
else {
	echo "No College Selected";
}
?></h3>
<div class=container>
<div class="table-responsive">
            <table class="table table-hover">
              <thead>
			   <tr>
                  <th></th>
                  <th>DEPARTMENTS</th>
                  <th>Click to see Gurus</th>
                </tr>
           </thead>
		   <?php
		   require_once 'allfunction.php';
		   $link=connect();
		   if(isset($_GET['college']))
		   {
		   $co=strtoupper($_GET['college']);
$collegetable="";
$avg="";
$i="";
$query=mysql_query("select distinct tdepart from teachers where tcollege='$co';");
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
$collegetable= "<tr><td></td><td> ".strtoupper($value[0])."</td><td><form method=GET action=gurus.php><input type=hidden name=dept value='".$value[0]."'><input type=hidden value='".$co."' name=college><input class='btn btn-primary btn-md' type=submit value='See The Gurus'></button></form></td></tr>";
echo $collegetable;
}
echo "<tr><td colspan=8>If your department is not listed, you can contact us and get your department listed</td></tr>";
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