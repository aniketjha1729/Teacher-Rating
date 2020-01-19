<?php
require_once 'allfunction.php';
$link=connect();
if(isset($_POST['string'])){
	$s = mysql_real_escape_string($_POST['string']);
$query=mysql_query("select distinct tcollege from teachers where tcollege like '%$s%' order by tcollege limit 5");
if(mysql_num_rows($query)>0){
	while($row = mysql_fetch_object($query)){?>
		<a onclick="fillme('<?php echo $row->tcollege?>');">
			<div class="user_div">
				<div class="clg"><?php echo strtoupper($row->tcollege)?></div>
			</div>
		</a>
		<?php }
		}else{?>
		<div class="no_data">looks like your college isnt in your records, but you can sign up still</div></a>
		<?php }
}
	?>