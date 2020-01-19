<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#2196F3">
    <title>RateYourGuru
</title>
    <link rel="icon" href="image/favicon.ico">
<!-- Animate.css -->
	<link rel="stylesheet" href="css1/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css1/icomoon.css">
	<!-- Simple Line Icons -->
	<link rel="stylesheet" href="css1/simple-line-icons.css">
	<!-- Bootstrap  -->
	<link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="bs/css/bootstrap.css">
<link rel="stylesheet" href="bs/css/my.css">
	<link rel="stylesheet" href="css1/blue.css">
	<script src="js1/modernizr-2.6.2.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- purana -->
<link rel="stylesheet" type="text/css" href="stylesearch.css">
<script src="jquery-1.10.2.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$("#search_box").keyup(function(){var search_string = $("#search_box").val();
if(search_string == ''){$("#searchres").html('');}else{postdata = {'string' : search_string}
$.post("search.php",postdata,function(data){	$("#searchres").html(data);	});}});});
function fillme(name){$("#search_box").val(name);$("#searchres").html('');}
</script>