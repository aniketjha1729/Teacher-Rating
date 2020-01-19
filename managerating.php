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
	//return;
}
?>
<?php
require_once('allfunction.php');
$link=connect();
$name="";
$tname="";
$college="";
$tdept="";
$query="select * from students where email='$email'";
$result=mysql_query($query,$link);
$row=mysql_fetch_array($result);
$name=$row['name'];
$id=$row['sid'];
$college=$row['college'];
$dept=$row['dept'];
$teacherarray=searchteacher($link,$college,$dept);
$msg2="";
if(isset($_GET['submitmod']))
{
	$tid=intval($_GET['teacherid']);
	$sir=intval($_GET['simtrating']);
	$cr=intval($_GET['cleartrating']);
	$ur=intval($_GET['undertrating']);
	$sur=intval($_GET['supportrating']);
	$tor=($sir+$cr+$ur+$sur)/4;
	if($tor>=1 && $tor<=10)
	{
	$tr=$_GET['treview'];
	$ia=$_GET['ia'];
	$query=mysql_query("update ratings set trating='$tor',simtrating='$sir',cleartrating='$cr',supportrating='$sur',utrating='$ur',treview='$tr',ia='$ia' where sid='$id' and tid='$tid'");
    $msg2="<div class='alert alert-success'>update successful</div>";
	}
	else 
		$msg2="<div class='alert alert-danger'>Please Dont touch the Url _/\_</div>";
}
$msg1="";
if(isset($_GET['subdelete']))
{ 
	$tid=intval($_GET['teacherid']);
	$query=mysql_query("delete from ratings where tid='$tid' and sid='$id'");
	$msg1="<div class='alert alert-success'>record successfully Deleted</div>";
}
disconnect($link);
?>
<html>
<head><title></title>
<?php require_once 'head.php';?>
<style>
      .rating {
  background: #fff;
}
input[type="radio"] {
  position: fixed;
  top: 0;
  z-index: -23;
  right: 10%;
}

label {
  font-size: 1.7em;
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

    
    <script type="text/javascript">
     function moveContentTo2(x)
    {           
    	 	document.getElementById("modifyval1").value = x;
    }
     function moveContentTo1(y)
     {           
     	 	document.getElementById("deleteval").value = y;
     }
 </script> 
</head>
<body>
<?php include 'templateuser.php';?>
  <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
        <ul class="nav nav-sidebar"></ul>
          <ul class="nav nav-sidebar"></ul>
          <ul class="nav nav-sidebar">
            <ul class="nav nav-sidebar">
            <li><a href="userhome.php">HELLO <?php echo $name;?></a></li>
            <li><a href="userpwdchange.php">Change Password</a></li>
            <li><a href="updateuser.php">Update Profile</a></li>
            <li class="active"><a href="managerating.php">Manage Ratings <span class="sr-only">(current)</span></a></li>
          </ul>
          <ul class="nav nav-sidebar"></ul>
          <ul class="nav nav-sidebar"></ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">The Ratings You gave are-</h1>
        <?php echo $msg1; echo $msg2;?>
             <div class="table-responsive">
            <table class="table table-hover">
              <thead>
			   <tr>
                  <th></th>
                  <th>Teacher Name</th>
                  <th>Total Ratings You Gave</th>
                  <th>Your Review</th>
                </tr>
           </thead>
           <?php 
          $link=connect();
          $i="";
          $ratings="";
          $ratingmanage="";
          $query=mysql_query("select * from ratings where sid='$id'");
          while($row=mysql_fetch_array($query))
          {
          	$ratings[$i]=$row;
          	$i++;
          }
          if($ratings==0)
          {
          	echo "<tr><td colspan=3>Rate some teachers and come here again :-)</td><tr>";
          }
          	else
          	{
          foreach ($ratings as $value)
          {
          	$ratingmanage="<tr><td><img src=images/image_$value[1].jpg onerror=(this.src=images/default.png) style='width: 150px;height: 120px;' class='img-rounded'></img></td><td>".$value['tname']."</td><td>".$value['trating']."<span class='fa fa-star' style='color: orange;'></span></td><td colspan=3 style='max-width: 300px'><p>".htmlspecialchars($value['treview'], ENT_QUOTES, 'UTF-8')."<p></td><td></td><td><button class='btn btn-primary btn-sm' type=submit data-toggle=modal data-target=#modify id=modifyval value=".$value[1]." onclick='moveContentTo2(this.value)'>Modify This</button></td><td><button class='btn btn-primary btn-sm' type=submit data-toggle=modal data-target=#delete value=".$value[1]." onclick='moveContentTo1(this.value)'>DELETE</button></td></tr>";
          	echo $ratingmanage;
          }
            }       
     ?>
          </table>
          </div>
          </div>
          </div>
          </div>
          <!-- modal -->

<div class="modal fade" id="modify" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Modify Your Ratings</h4>
      </div>
      <div class="modal-body">
          <div class="table-responsive">
		   <form name=modify method=GET action="">
            <table class="table table-hover">
              <thead>
			   <tr>
                  <th>Simple Teaching</th>
				  </tr>
           </thead>
		   <tbody>
		<tr><td>
		<div class="rating" style="" >
		<input type="radio" name="simtrating" id="one" value=1 checked /><label for="one"><i class="fa fa-star"></i></label>
		<input type="radio" name="simtrating" id="two" value=2 /><label for="two"><i class="fa fa-star"></i></label>
		<input type="radio" name="simtrating" id="three" value=3 /><label for="three"><i class="fa fa-star"></i></label>
		<input type="radio" name="simtrating" id="four" value=4 /><label for="four"><i class="fa fa-star"></i></label>
		<input type="radio" name="simtrating" id="five" value=5 /><label for="five"><i class="fa fa-star"></i></label>
		<input type="radio" name="simtrating" id="six" value=6 /><label for="six"><i class="fa fa-star"></i></label>
		<input type="radio" name="simtrating" id="seven" value=7 /><label for="seven"><i class="fa fa-star"></i></label>
		<input type="radio" name="simtrating" id="eight" value=8 /><label for="eight"><i class="fa fa-star"></i></label>
		<input type="radio" name="simtrating" id="nine" value=9 /><label for="nine"><i class="fa fa-star"></i></label>
		<input type="radio" name="simtrating" id="ten" value=10 /><label for="ten"><i class="fa fa-star"></i></label>
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
  <div class="checkbox"><label>
  <input type=checkbox value="1" name="ia">Post As Anonymous<br>
 </label> </div><br>
 <hr>
 <input type=hidden id=modifyval1 name=teacherid value="">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="btn btn-primary" type=submit value="Review Done" name="submitmod">
</form>
      </div>
    </div>
  </div>
</div>     
</div>     
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Are You Sure You want to Delete This Rating?</h4>
      </div>
      <div class="modal-body">
        <div class=row>
        <form><button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <input type=hidden id=deleteval name=teacherid value="">
        <input type=submit class="btn btn-danger" name=subdelete value=Delete></form>
      </div>
      </div>
      </div>
      </div>
      </div>
      <?php require_once 'footer.php';?>
          </body>
          </html>