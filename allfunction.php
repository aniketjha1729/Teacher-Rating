<?php
$name="";
$tname="";
$tcollege="";
$college="";
function connect()
{
$link=mysql_connect("localhost","techdgyz_ankit","Temp123$%");
if (!$link)
{
  echo "Please try later.";
}
else
{

mysql_select_db("techdgyz_ryg",$link) ;
}
return $link;
}
function checklogin($link,$email,$pwd,$name)
{

$query="select pwd from students where email='$email'";	
$result=mysql_query($query,$link);
$row=mysql_fetch_array($result);
	if($row{0}==$pwd)
	{
		session_start();
		$_SESSION['email']=$email;
		header('Location: http://rateyourguru.in/userhome.php');
		echo "code running";
		return true;
	}
	else 
		echo "<button type='button' class='btn btn-danger'>Entered email or password is wrong</button>";
		return false;
}
function searchteacher($link,$college,$dept)
{   $i="";
    $teacherarray= array();
	$query="select * from teachers where tcollege='$college' and tdepart='$dept'";
	$result=mysql_query($query,$link);
	while($row=mysql_fetch_array($result))
	{
		$teacherarray[$i]=$row;
		$i++;
	}
	return $teacherarray;
    if($result<1)
 echo "No Teacher Available ";
}
function disconnect($link)
{	
	mysql_close($link);
	return $link;
}
?>