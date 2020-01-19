<?php
require_once 'allfunction.php';
session_start();
if(isset($_SESSION['email']))
{
	$email=$_SESSION['email'];
	header('location:userhome.php');
}
?>
<html lang="en">
<head>

<?php
require_once 'headhome.php';


?> 
<meta name="alexaVerifyID" content="DB3Luh8jniMXRaiM1F6n5NPb-78"/>
<title>Rate The Tutor</title>
<style>
.carousel .item {
    left: 0 !important;
      -webkit-transition: opacity .4s; /*adjust timing here */
         -moz-transition: opacity .4s;
           -o-transition: opacity .4s;
              transition: opacity .4s;
}
.carousel-control {
    background-image: none !important; /* remove background gradients on controls */
}
/* Fade controls with items */
.next.left,
.prev.right {
    opacity: 1;
    z-index: 1;
}
.active.left,
.active.right {
    opacity: 0;
    z-index: 2;
}
</style>
<link rel=stylesheet href="css1/home.css">
<script type="text/javascript">
$(document).ready(function(){
$("#search_box").keyup(function(){var search_string = $("#search_box").val();
if(search_string == ''){$("#searchres").html('');}else{postdata = {'string' : search_string}
$.post("searchhome.php",postdata,function(data){	$("#searchres").html(data);	});}});});
function fillme(name){$("#search_box").val(name);$("#searchres").html('');}
</script>
</head>
<body>

<?php require_once 'templatehome.php';?>
	

<!-- Carousel
================================================== -->
<div id="myCarousel" class="carousel slide">

  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <div class="carousel-inner">
    <div class="item active">
      <img src="image/home6.jpg" style="width:100%" class="img-responsive">
      <div class="container">
        <div class="carousel-caption">
          <h1 style="color: yellow;font-weight: 900;background: rgba(237, 20, 61, 0.27);text-shadow: 0 0 8px #E5F, 0 0 0 #03A9F4;font-family: 'Signika', sans-serif;">India's First Teacher Rating Website</h1>
          <p style="color: black;text-shadow: 0 0 8px yellowgreen;">Taking The Indian Education System To Next level</p>
          <p><a class="btn btn-lg btn-info" href="login.php">Sign Up Now</a>
        </p>
        </div>
      </div>
    </div>
    <div class="item">
      <img src="image/teacher.gif" class="img-responsive">
      <div class="container">
        <div class="carousel-caption">
          <h1 style="text-shadow: 0 0 10px #E5FF00, 0 0 10px #0000FF;color: gold;">Help The Gurus And The students</h1>
          <p>The Ratings And Reviews You Provide Will Help Gurus As Well As The Students To Improve</p>
          <p><a class="btn btn-lg btn-info" href="#">About us</a></p>
        </div>
      </div>
    </div>
    <div class="item">
      <img src="image/home5.jpg" class="img-responsive center-block">
      <div class="container">
        <div class="carousel-caption">
          <h1 style="color: #ff4411;background: rgba(33, 150, 243, 0.21);font-weight: 900;font-family: 'Signika', sans-serif;padding-bottom: 10px;}">Express Your Views On The Education You Are Getting</h1>
          <p style="color: black;background-color: rgba(255, 255, 255, 0.73);">It Will Help You To Be Part Of Advancing Education In India</p>
          <p><a class="btn btn-lg btn-info" href="#">See ratings</a></p>
        </div>
      </div>
    </div>
  </div>
  <!-- Controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="icon-prev"></span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="icon-next"></span>
  </a>  
</div>
<!-- search bar -->
<div class="col-lg-5 col-lg-offset-3">
    <form method="get" action="teacherrating.php">
    <div class="input-group">
      <input type="text" class="form-control"   name="name" id="search_box" required autocomplete="off" onclick=abc(); placeholder="Search for any guru of your college..">
      <br>
      <div id="searchres" class="searchres"></div>
      <span class="input-group-btn">
        <button class="btn btn-default" type="button"><i class="fa fa-search"></i>
        </button>
      </span>
      
    </div><!-- /input-group -->
</form>
    </div>

<!-- corosuel over -->
		
  <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row">
        <div class="col-lg-4">
          <img class="img-circle">
		  <p class=points><?php 
		    require_once 'allfunction.php';
            $link=connect();
            $q=mysql_query("SELECT COUNT(DISTINCT tcollege) FROM teachers;");
			$r=mysql_fetch_array($q);
			echo $r{0}+80;
			disconnect($link);
		  ?><p>
          <h3>Total Colleges</h3>
          <p></p>
          <p><a class="btn btn-default" href="college.php" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="img-circle">
		  <p class=points><?php
           $link=connect();
            $q=mysql_query("SELECT COUNT(DISTINCT tid) FROM teachers;");
			$r=mysql_fetch_array($q);
			echo $r{0}+10000;
			disconnect($link);
		  ?></p>
          <h3>Total Gurus</h3>
          <p><a class="btn btn-default" href="college.php" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="img-circle">
		  <p class=points><?php
           $link=connect();
            $q=mysql_query("SELECT COUNT(DISTINCT rid) FROM ratings;");
			$r=mysql_fetch_array($q);
			echo $r{0}+100;
			disconnect($link);
		  ?>
		  </p>
          <h3>Total Ratings</h3>
          <p></p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->
      
</div>
<div class="well well-lg"">
<h3>We are adding new colleges everyday.</h3><br><p>You can also be a part of this awesome startup. Just contact us.</p></div>
<br>
<div class="well well-lg"><center>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- big hori -->
<ins class="adsbygoogle"
     style="display:inline-block;width:970px;height:250px"
     data-ad-client="ca-pub-8403262670102197"
     data-ad-slot="9176604461"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script></center>
</div>
<br>
 <?php require_once 'footer.php';?>
</body>
</html>