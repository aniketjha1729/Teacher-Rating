<?php 
require_once 'allfunction.php';
$con=connect();
if(isset($_POST['string'])){
	$s = mysql_real_escape_string($_POST['string']);
	$query = "select * from teachers where tname like '%$s%' order by tname limit 5";
	$res = mysql_query($query);
	if(mysql_num_rows($res)>0){
	while($row = mysql_fetch_object($res)){?>
	<a target="_blank" href="seeratings.php?id=<?php echo $row->tid;?>" onclick="fillme('<?php echo $row->tname?>');">
		<div class="user_div">
			<img src="images/image_<?php echo $row->tid;?>.jpg" onerror=(this.src='images/default.png') style="width:50px;height:50px;border-radius:5px;float:left;">
			<div class="name"><?php echo $row->tname?></div><br><div class="college"><?php echo strtoupper($row->tcollege);?></div>
		    <form><input type=hidden name=teaid value="<?php echo $row->tid;?>"></form>
		</div>
	</a>
	<?php }
	}else{?>
	<a target="_blank" href="college.php">
	<div class="no_data">NO Result Found - Search By College</div></a>
	<?php }
}
?>

