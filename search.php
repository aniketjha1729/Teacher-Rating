<?php 
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
require_once 'allfunction.php';
$con=connect();
$q=mysql_query("select college from students where email='$email'");
$row=mysql_fetch_array($q);
$college=$row[0];
if(isset($_POST['string'])){
	$s = mysql_real_escape_string($_POST['string']);
	$query = "select * from teachers where tname like '%$s%' and tcollege='$college' order by tname limit 5";
	$res = mysql_query($query);
	if(mysql_num_rows($res)>0){
	while($row = mysql_fetch_object($res)){?>
	<a onclick="fillme('<?php echo $row->tname?>');">
	<form name="f'<?php echo $row->tname?>'" method="POST" action="teacherrating.php">
		<div class="user_div">
			<img src="images/image_<?php echo $row->tid;?>.jpg" onerror=(this.src='images/default.png') style="width:50px;height:50px;border-radius:5px;float:left;">
			<div class="name"><?php echo $row->tname?></div><br><div class="college"><?php echo strtoupper($row->tcollege);?></div>
		    <form><input type=hidden name=tid value="<?php echo $row->tid;?>"></form>
		</div>
	</a>
	<?php }
	}else{?>
	<div class="no_data">No Result Found !</div>
	<?php }
}
?>
