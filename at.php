<html>
<head><title></title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
<link href="signin.css" rel="stylesheet">
<script src="js/bootstrap.min.js"></script>
<script src="js/npm.js"></script>
<style>
.form-control
{
	    background: white; 
    border: 1px solid #ffa853; 
    border-radius: 5px; 
    box-shadow: 0 0 5px 3px #ffa853; 
    color: #666; 
    outline: none; 
    height:23px; 
    width: 275px; 
	height: 40px;
}

</style>
</head>
<body><div>
<?php 
require_once 'allfunction.php';
$link=connect();
$query="select max(tid)+1 from teachers where tid is Not Null";
$result=mysql_query($query,$link);
$row=mysql_fetch_array($result);
if(isset($_GET['sub']))
{
    $tid=$_GET['tid'];
	$tname=$_GET['name'];
	$tcollege=$_GET['tcollege'];
	$tdepart=$_GET['tdepart'];
	$tqual=$_GET['tqual'];
	$tstate=$_GET['tstate'];
$query="insert into teachers (tid,tname,tdepart,tcollege,tqual,tstate) values ($tid,'$tname','$tdepart','$tcollege','$tqual','$tstate')";
$result=mysql_query($query,$link);
echo "teacher enter successfully";
header('location:at.php');
}

?>
</div>

 <form class="form-horizontal" role="form" enctype="multipart/form-data" action="" name=f1 method="GET" action="">
<div class="form-group">
      <label class="control-label col-sm-2" for="tid"> Teacher ID:</label>
      <div class="col-sm-6">          
        <input type="text" class="form-control" id="tid" name="tid" value=<?php echo $row{0};?>>
      </div>
    </div> 
<div class="form-group">
      <label class="control-label col-sm-2" for="name"> Teacher Name:</label>
      <div class="col-sm-6">          
        <input type="text" class="form-control" id="name" name="name" autocomplete=on placeholder="Enter teacher full name" required>
      </div>
    </div>  
	<div class="form-group">
      <label class="control-label col-sm-2" for="tdepart"> Teacher Department</label>
      <div class="col-sm-6">          
        <input type="text" class="form-control" id="tdepart" name="tdepart" autocomplete=on placeholder="Enter teachers department" required>
      </div>
    </div>  <div class="form-group">
      <label class="control-label col-sm-2" for="tcollege"> Teacher College</label>
      <div class="col-sm-6">          
        <input type="text" class="form-control" id="tcollege" name="tcollege" autocomplete=on placeholder="Enter teacher's college" required>
      </div>
    </div>  <div class="form-group">
      <label class="control-label col-sm-2" for="tqual"> Qualification</label>
      <div class="col-sm-6">          
        <input type="text" class="form-control" id="tqual" name="tqual" autocomplete=on placeholder="Enter teacher qualification" required>
      </div>
    </div>  
    <div class="form-group">
      <label class="control-label col-sm-2" for="tstate"> Designation:</label>
      <div class="col-sm-6">          
        <input type="text" class="form-control" id="tstate" name="tstate" autocomplete=on placeholder="Enter teacher degination" required>
      </div>
	  
	  <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default" name="sub">Submit</button>
      </div>
    </div>
    </div>
  </form>
</body>

</html>