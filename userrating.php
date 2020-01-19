<?php
require_once 'allfunction.php';
session_start();
if(isset($_SESSION['email']))
{
	$email=$_SESSION['email'];

	}
else
{
	$_SESSION['errmsg']="Not a valid User.Please Login!";
	header('location: index.php');
}

$link=connect();
$id="";
$sid="";
$msg2="";
$msg="";
$query="select * from students where email='$email'";
$result=mysql_query($query,$link);
$row=mysql_fetch_array($result);
$sid=$row['sid'];
$name=$row['name'];
$college=$row['college'];
$id=$_POST['id'];
$id = intval(preg_replace('/[^0-9]+/', '', $id), 10);
$q=mysql_query("select * from teachers where tid='$id'");
$r=mysql_num_rows($q);
if($r==0)
{
$msg2="<button type=button class='btn btn-danger'>No teacher with this id exists. You will be riderected to home page</button>";	
header( "Refresh:5; url=userhome.php", true, 303);
}
else
{
$q=mysql_query("select * from teachers where tid='$id'");
$r=mysql_fetch_array($q);
$tcollege=$r['tcollege'];
$tname=$r['tname'];
  
  $msg="";
  if(isset($_POST['submit']))
  {

	  global $msg,$id,$sid;
  $trating="";
  $treview="";
  $strating="";
  $ctrating="";
  $sutrating="";
  $utrating="";
  $ia="";
  $ia=isset($_POST['ia']);
  $utrating=$_POST['undertrating'];
  $strating=$_POST['simtrating'];
  $ctrating=$_POST['cleartrating'];
  $sutrating=$_POST['supportrating'];
  $trating=($strating+$utrating+$ctrating+$sutrating)/4;
  $treview=$_POST['treview'];
  $query1="select trating from ratings where tid='$id' and sid='$sid'";
  $result=mysql_query($query1,$link);
  $row=mysql_fetch_array($result);
  $d=$row{0};
  if($d == NULL)
  {
	 $query1="select max(rid)+1 from ratings where 1";
    $result1=mysql_query($query1,$link);
    $row1=mysql_fetch_array($result1);
    $rid=$row1{0};
    $query2="select tid from teachers where tname='$tname'";
    $result2=mysql_query($query2,$link);
    $row2=mysql_fetch_array($result2);
    $tid=$row2{0};
    $query3="select sid from students where email='$email'";
    $result3=mysql_query($query3,$link);
    $row3=mysql_fetch_array($result3);
    $sid=$row3{0};
    $query="insert into ratings (rid,tid,sid,trating,cleartrating,supportrating,simtrating,utrating,treview,ia,tname) values ('$rid','$tid','$sid','$trating','$ctrating','$sutrating','$strating','$utrating','$treview','$ia','$tname')";
	$result=mysql_query($query,$link);
    $msg="<button type=button class='btn btn-success'>thanks for rating select other teacher from <a href=userhome.php>here</a></button>";
	header( "Refresh:5; url=userhome.php", true, 303);
    
	 }
	 else{
		 $msg="<button type=button class='btn btn-danger'>you have already rated this teacher select other teacher from <a href=userhome.php>here</a></button>";
		 header( "Refresh:5; url=userhome.php", true, 303);
	 }
  } }
?>
<!DOCTYPE html>
<html >
  <head> 
    <meta charset="UTF-8">
    <title>RATE THE TUTOR</title>
	
	<?php require_once 'head.php';?>
	<style>
      .rating {
  background: #fff;
}
input[type="radio"] {
  position: fixed;
  top: 0;
  right: 100%;
}

label {
  font-size: 1.5em;
  padding: 0.5em;
  margin: 0;
  float: left;
  cursor: pointer;
  -moz-transition: 0.2s;
  -o-transition: 0.2s;
  -webkit-transition: 0.2s;
  transition: 0.2s;
}

input[type="radio"]:checked ~ input + label {
  background: none;
  color: #aaa;
}

input + label {
  background: #fff;
  color: orange;
  margin: 0 0 1em 0;
}

input + label:first-of-type {
  border-top-left-radius: 8px;
  border-bottom-left-radius: 8px;
}

input:checked + label {
  border-top-right-radius: 8px;
  border-bottom-right-radius: 8px;
}

hr {
  clear: both;
  border: 0;
  border-top: 2px solid #999;
  margin: 2em 0;
}

    </style>   
        <script src="js/prefixfree.min.js"></script>
 
 </head>
   <body>
<?php require_once'templateuser.php';?>
 <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
        <ul class="nav nav-sidebar"></ul>
          <ul class="nav nav-sidebar"></ul>
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">HELLO <?php echo $name;?> <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Change Password</a></li>
            <li><a href="#">Update Profile</a></li>
            <li><a href="#">Manage Ratings</a></li>
          </ul>
          <ul class="nav nav-sidebar">
         
          </ul>
          <ul class="nav nav-sidebar">
          </ul>
        </div>

                 <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"></h1>
		  <?php echo $msg;?>
		  <?php echo $msg2;?>
		   <h2 class="sub-header">Rate The Teacher on the basis of your personal experience</h2>
			  <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="<?php if(file_exists("images/image_".$id.".jpg")){echo "images/image_".$id.".jpg";}else{echo "images/default.png";};?>" width="200" height="200" class="img-responsive img-thumbnail" alt="">
              <h4><?php echo $tname;?></h4>
              <span class="text-muted"><?php echo strtoupper($tcollege);?></span>
            </div>
            
			
		  <h2 class="sub-header">Rate The teaching Skills of "<?php echo $tname;?>"</h2>
       
		
		   <div class="table-responsive">
		   <form name=f1 method=POST action="">
            <table class="table table-hover">
              <thead>
			   <tr>
                  <th>Simple Teaching</th>
				  </tr>
           </thead>
		   <tbody>
		<tr><td>
		<div class="rating" style="" >
		<input type="radio" name="simtrating" id="one" value=1 checked /><label for="one">1<i class="fa fa-star"></i></label>
		<input type="radio" name="simtrating" id="two" value=2 /><label for="two">2<i class="fa fa-star"></i></label>
		<input type="radio" name="simtrating" id="three" value=3 /><label for="three">3<i class="fa fa-star"></i></label>
		<input type="radio" name="simtrating" id="four" value=4 /><label for="four">4<i class="fa fa-star"></i></label>
		<input type="radio" name="simtrating" id="five" value=5 /><label for="five">5<i class="fa fa-star"></i></label>
		<input type="radio" name="simtrating" id="six" value=6 /><label for="six">6<i class="fa fa-star"></i></label>
		<input type="radio" name="simtrating" id="seven" value=7 /><label for="seven">7<i class="fa fa-star"></i></label>
		<input type="radio" name="simtrating" id="eight" value=8 /><label for="eight">8<i class="fa fa-star"></i></label>
		<input type="radio" name="simtrating" id="nine" value=9 /><label for="nine">9<i class="fa fa-star"></i></label>
		<input type="radio" name="simtrating" id="ten" value=10 /><label for="ten">10<i class="fa fa-star"></i></label>
</div>
		</td>
		</tr>
</tbody>
</table>


<table class="table table-hover">
              <thead>
			   <tr>
                  <th>Clear's all The Doubts</th>
				  </tr>
           </thead>
		   <tbody>
		<tr><td>
		<div class="rating1">
		<input type="radio" name="cleartrating" id="one1" value=1 checked /><label for="one1"><i class="fa fa-star"></i></label>
		<input type="radio" name="cleartrating" id="two1" value=2 /><label for="two1"><i class="fa fa-star"></i></label>
		<input type="radio" name="cleartrating" id="three1" value=3 /><label for="three1"><i class="fa fa-star"></i></label>
		<input type="radio" name="cleartrating" id="four1" value=4 /><label for="four1"><i class="fa fa-star"></i></label>
		<input type="radio" name="cleartrating" id="five1" value=5 /><label for="five1"><i class="fa fa-star"></i></label>
		<input type="radio" name="cleartrating" id="six1" value=6 /><label for="six1"><i class="fa fa-star"></i></label>
		<input type="radio" name="cleartrating" id="seven1" value=7 /><label for="seven1"><i class="fa fa-star"></i></label>
		<input type="radio" name="cleartrating" id="eight1" value=8 /><label for="eight1"><i class="fa fa-star"></i></label>
		<input type="radio" name="cleartrating" id="nine1" value=9 /><label for="nine1"><i class="fa fa-star"></i></label>
		<input type="radio" name="cleartrating" id="ten1" value=10 /><label for="ten1"><i class="fa fa-star"></i></label>
</div>
		</td>
		</tr>
</tbody>
</table>

<table class="table table-hover">
              <thead>
			   <tr>
                  <th>Teaches in Understandable Language</th>
				  </tr>
           </thead>
		   <tbody>
		<tr><td>
		<div class="rating2">
		<input type="radio" name="undertrating" id="one3" value=1 checked /><label for="one3"><i class="fa fa-star"></i></label>
		<input type="radio" name="undertrating" id="two3" value=2 /><label for="two3"><i class="fa fa-star"></i></label>
		<input type="radio" name="undertrating" id="three3" value=3 /><label for="three3"><i class="fa fa-star"></i></label>
		<input type="radio" name="undertrating" id="four3" value=4 /><label for="four3"><i class="fa fa-star"></i></label>
		<input type="radio" name="undertrating" id="five3" value=5 /><label for="five3"><i class="fa fa-star"></i></label>
		<input type="radio" name="undertrating" id="six3" value=6 /><label for="six3"><i class="fa fa-star"></i></label>
		<input type="radio" name="undertrating" id="seven3" value=7 /><label for="seven3"><i class="fa fa-star"></i></label>
		<input type="radio" name="undertrating" id="eight3" value=8 /><label for="eight3"><i class="fa fa-star"></i></label>
		<input type="radio" name="undertrating" id="nine3" value=9 /><label for="nine3"><i class="fa fa-star"></i></label>
		<input type="radio" name="undertrating" id="ten3" value=10 /><label for="ten3"><i class="fa fa-star"></i></label>
</div>
		</td>
		</tr>
</tbody>
</table>




<table class="table table-hover">
              <thead>
			   <tr>
                  <th>Supportive in Class</th>
				  </tr>
           </thead>
		   <tbody>
		<tr><td>
		<div class="rating3">
		<input type="radio" name="supportrating" id="one2" value=1 checked /><label for="one2"><i class="fa fa-star"></i></label>
		<input type="radio" name="supportrating" id="two2" value=2 /><label for="two2"><i class="fa fa-star"></i></label>
		<input type="radio" name="supportrating" id="three2" value=3 /><label for="three2"><i class="fa fa-star"></i></label>
		<input type="radio" name="supportrating" id="four2" value=4 /><label for="four2"><i class="fa fa-star"></i></label>
		<input type="radio" name="supportrating" id="five2" value=5 /><label for="five2"><i class="fa fa-star"></i></label>
		<input type="radio" name="supportrating" id="six2" value=6 /><label for="six2"><i class="fa fa-star"></i></label>
		<input type="radio" name="supportrating" id="seven2" value=7 /><label for="seven2"><i class="fa fa-star"></i></label>
		<input type="radio" name="supportrating" id="eight2" value=8 /><label for="eight2"><i class="fa fa-star"></i></label>
		<input type="radio" name="supportrating" id="nine2" value=9 /><label for="nine2"><i class="fa fa-star"></i></label>
		<input type="radio" name="supportrating" id="ten2" value=10 /><label for="ten2"><i class="fa fa-star"></i></label>
</div>
		</td>
		</tr>
</tbody>
</table>


<hr>
<div class="form-group">
  <label for="comment">Comment:</label>
  <textarea name=treview class="form-control" rows="5" id="comment" placeholder="Write your honest review of your experience."></textarea>
</div> 
  <input type=hidden name="id" value="<?php global $id; echo $id;?>">
  <div class="checkbox"><label>
  <input type=checkbox value="1" name="ia">Post As Anonymous<br>
 </label> </div><br>
  <input class="btn btn-primary btn-lg" type=submit value="Review Done" name="submit">
</form>
</div>
</div>
</div>
</div>
</div>
 
  </body>
</html>
