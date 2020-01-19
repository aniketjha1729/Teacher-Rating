<?php
require_once 'allfunction.php';
$link=connect();
if(isset($_POST['string'])){
	$s = mysql_real_escape_string($_POST['string']);
$query=mysql_query("select distinct tcollege from teachers where tcollege like '%$s%' order by tcollege limit 5");
if(mysql_num_rows($query)>0){
	while($row = mysql_fetch_object($query)){?>
		<a href="departments.php?college=<?php echo strtoupper($row->tcollege);?>" onclick="fillme('<?php echo $row->tcollege?>');">
			<div class="user_div">
				<div class="name"><?php echo strtoupper($row->tcollege);?></div>
			</div>
		</a>
		<?php }
		}else{?>
		<div class="no_data">oops! Looks Like your college isn't in Our Records, leave us a message and we will add it soon</div></a>
		<?php }
}
	?>