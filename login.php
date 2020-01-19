<html>
<head>
<?php require_once 'headhome.php';?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="js/npm.js"></script>
<title>Rate The Tutor</title>
<script type="text/javascript">
$(document).ready(function(){
$("#search_box").keyup(function(){var search_string = $("#search_box").val();
if(search_string == ''){$("#searchres").html('');}else{postdata = {'string' : search_string}
$.post("getcollege.php",postdata,function(data){	$("#searchres").html(data);	});}});});
function fillme(name){$("#search_box").val(name);$("#searchres").html('');}
</script>
</head>
<body>
<?php require_once 'templatehome.php';?>
<h1>India's First Teacher Rating Website </h1><br>
<hr>
<?php
require_once 'headhome.php';
require_once 'allfunction.php';
$link=connect();
if(isset($_POST['submit']))
{
	$email=$_POST['email'];
	$pwd=$_POST['pwd'];
	$query="select name from students where email='$email'";
	$result=mysql_query($query,$link);
	$row=mysql_fetch_array($result);
	$name=$row{0};
	checklogin($link, $email, $pwd, $name);
}
elseif(isset($_POST['sub']))
{   

    $name=mysql_real_escape_string($_POST['name']);
	$mail=mysql_real_escape_string($_POST['semail']);
    $pwd=$_POST['spwd'];
	$cpwd=$_POST['cspwd'];
	$dob=mysql_real_escape_string($_POST['dob']);
	$college=mysql_real_escape_string($_POST['clg']);
    $dept=mysql_real_escape_string($_POST['dept']);
	$query=mysql_query("select max(sid+1) from students");
	$row=mysql_fetch_array($query);
	$id=$row{0};
if(strcmp($pwd,$cpwd)==0)
	{   
        $m=mysql_query("select * from students where email='$mail'");
		$r=mysql_num_rows($m);
		if($r==0)
		{
				$q=mysql_query("insert into students (sid,name,email,pwd,dob,college,dept) values ('$id','$name','$mail','$pwd','$dob','$college','$dept')",$link);
		echo "<div class='alert alert-success'>Registration Successfully Completed</div>";
		}
		else
		{
			echo "<div class='alert alert-danger'>Email address Already exists, login or try another email address</div>";
		}
	}
else
	{
		echo "<div class='alert alert-warning'>Both the Password should match</div>";
	}

}	disconnect($link);
?> 
 <div class="container-fluid">
 <div class="row">
 
 <div class="col-sm-4 col-md-7 col-lg-6 container">
  <h2>Login here</h2>
  <form class="form-horizontal" role="form" enctype="multipart/form-data" action="" name=f1 method="POST" action="">
    <div class="form-group">
      <label class="control-label col-sm-4" for="email">Email</label>
      <div class="col-sm-6">
        <input type="Email" class="form-control" id="Email" name="email" placeholder="Enter Email Address" required>
      </div>
    </div>
  
	  <div class="form-group">
      <label class="control-label col-sm-4" for="pwd">Password</label>
      <div class="col-sm-6">          
        <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Enter Password" required>
      </div>
    </div>  
	 <div class="form-group">        
      <div class="col-sm-offset-3 col-sm-10">
        <div class="checkbox">
          <label><input type="checkbox">Remember me</label>
        </div>
      </div>
    </div>
<div class="form-group">        
      <div class="col-sm-offset-4 col-sm-12">
        <button type="submit" class="btn btn-default" name="submit">Submit</button>
      </div>
    </div>
  </form>
</div>


<div class="col-lg-6 container">
  <h2>Didn't Signed Up Yet</h2>
  <h4>Sign Up Here</h4>
  <form class="form-horizontal" role="form"  data-toggle="validator" enctype="multipart/form-data" action="" name=f2 method="POST" action="">
    <div class="form-group">
      <label class="control-label col-sm-2" for="name"> Your Name:</label>
      <div class="col-sm-6">          
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your full name" required>
      </div>
    </div>  

	<div class="form-group">
      <label class="control-label col-sm-2" for="semail">Email</label>
      <div class="col-sm-6">
        <input type="Email" class="form-control" id="sEmail" name="semail" placeholder="Enter Email Address" required>
      </div>
    </div>
  
	  <div class="form-group">
      <label class="control-label col-sm-2" for="spwd">Password:</label>
      <div class="col-sm-6">          
        <input type="password" class="form-control" id="spwd" name="spwd" placeholder="Enter Password" required>
      </div>
    </div>  
	 <div class="form-group">
      <label class="control-label col-sm-2" for="cspwd"> Confirm Password:</label>
      <div class="col-sm-6">          
        <input type="password" class="form-control" id="cspwd" name="cspwd" placeholder="Confirm Password" required>
      </div>
    </div> 
    <div class="form-group">
      <label class="control-label col-sm-2" for="dob"> Date Of Birth:</label>
      <div class="col-sm-6">          
        <input type="date" max="2000-01-02" min="1975-01-02" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" class="form-control" id="dob" name="dob"  placeholder="pattern like 1994-12-30" required>
      </div>
    </div>	
	
	 <div class="form-group">
      <label class="control-label col-sm-2" for="clg"> Your College Name:</label>
      <div class="col-lg-6"> 
      <input type="text" class="form-control"   name="clg" id="search_box" required autocomplete="off" placeholder="Search for any guru of your college..">
      <div id="searchres" class="searchres"></div>
      </div>
    </div> 
	<div class="form-group">
      <label class="control-label col-sm-2" for="dept"> Your Department Name:</label>
      <div class="col-sm-6">   
<select class="form-control" id="dept" name="dept" placeholder="Enter Your department name" required>
	  <option value="" selected></option>
	  <?php
$link=connect();
$q=mysql_query("select distinct tdepart from teachers");
while($r=mysql_fetch_array($q))
{
echo "<option value='".$r['tdepart']."'>".strtoupper($r['tdepart'])."</option>";
}
disconnect($link);
	?>
	</select>
      </div>
    </div>  
	
	 <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label><input type="checkbox" required>All the details are correct</label>
        </div>
      </div>
    </div>
    <div class="g-recaptcha" data-sitekey="6LcTjxgTAAAAADhinlR9asmrRU2NVjvKH88fQNfm"></div>
<div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default" name="sub">Submit</button>
      </div>
    </div>
  </form>
</div>
</div>
</div>
 <?php require_once 'footer.php';?>
</body>
</html>