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
<script type="text/javascript">
$(document).ready(function(){
$("#search_box").keyup(function(){var search_string = $("#search_box").val();
if(search_string == ''){$("#searchres").html('');}else{postdata = {'string' : search_string}
$.post("getcollegehome.php",postdata,function(data){	$("#searchres").html(data);	});}});});
function fillme(name){$("#search_box").val(name);$("#searchres").html('');}
</script>
<title>Rate The Tutor</title>
<link rel=stylesheet href="css1/home.css">
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
      <img src="image/college (1).jpg" style="width:100%" class="img-responsive">
      <div class="container">
        <div class="carousel-caption">
          <h1 style="color: yellow;font-weight: 900;text-shadow: 0 0 8px #E5F, 0 0 0 #03A9F4;font-family: 'Signika', sans-serif;">India's First Teacher Rating Website</h1>
          <p style="color: black;text-shadow: 0 0 8px yellowgreen;">Taking The Indian Education System To Next level</p>
          <p><a class="btn btn-lg btn-info" href="login.php">Sign Up Now</a>
        </p>
        </div>
      </div>
    </div>
    <div class="item">
      <img src="image/college (1).png" class="img-responsive">
      <div class="container">
        <div class="carousel-caption">
          <h1 style="text-shadow: 0 0 10px #E5FF00, 0 0 10px #0000FF;color: gold;">Help The Gurus And The students</h1>
          <p>The Ratings And Reviews You Provide Will Help Gurus As Well As The Students To Improve</p>
          <p><a class="btn btn-lg btn-info" href="#">About us</a></p>
        </div>
      </div>
    </div>
    <div class="item">
      <img src="image/college (3).jpg" class="img-responsive">
      <div class="container">
        <div class="carousel-caption">
          <h1 style="text-shadow: 0 0 10px #E5FF00, 0 0 10px #0000FF;color: gold;">Help The Gurus And The students</h1>
          <p>The Ratings And Reviews You Provide Will Help Gurus As Well As The Students To Improve</p>
          <p><a class="btn btn-lg btn-info" href="#">About us</a></p>
        </div>
      </div>
    </div>
    <div class="item">
      <img src="image/college (2).jpg" class="img-responsive center-block">
      <div class="container">
        <div class="carousel-caption">
          <h1 style="color: #ff4411;font-weight: 900;font-family: 'Signika', sans-serif;padding-bottom: 10px;}">Express Your Views On The Education You Are Getting</h1>
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
    <form method="get" action="departments.php">
    <div class="input-group">
      <input type="text" class="form-control"   name="clg" id="search_box" required autocomplete="off" onclick=abc(); placeholder="Search for any college..">
      <br>
      <div id="searchres" class="searchres"></div>
      <span class="input-group-btn">
        <button class="btn btn-default" type="button"><i class="fa fa-search"></i>
        </button>
      </span>
      
    </div><!-- /input-group -->
</form>
    </div>

<?php require_once 'footer.php';?>
</body>
</html>