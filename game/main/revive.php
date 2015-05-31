<?php
require_once('../../class/dbinterface.php');  
require_once('../../class/dbmethods.php'); 
require_once('../../class/dbinfo.php');

$sql = new UserInfo(new UserDB('localhost','rpg',3306,'root',''));

$id = $_COOKIE['playerID'];
$result = $sql->getStats($id);

?>


<!DOCTYPE HTML>
<html>
<head>
<title>Blood Rite - The Lost Chapters</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.11.0.min.js"></script>
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/style1.css" type="text/css">

<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>
</head>
<body>
<!-- Header Starts Here -->
	<div class="header">
		<div class="container">
			
			<span class="menu"></span>
			<div class="navigation">
				<ul class="navig cl-effect-3" >
					<li><a href="index.html">Home</a></li>
					<li><a href="stats.php">Stats</a></li>
					<li><a href="play.html">Play</a></li>
					<li><a href="shop.html">Shop</a></li>
          			<li><a href="inventory.php">Inventory</a></li>
          			<li><a href="revive.php">Revive</a></li>
				</ul>
			</div>

		</div>
	</div>


<center>
	<?php 
	echo "<br><br><br><br><br><br><br>";

		if($result['Fighting'] == 1)
		  die("You are fighting, you can't make use of this centre right now.");
		if($result['HP'] <= 0)
		{
			$updateHPMP = $sql->updateHPMP($id);
			echo "<h1>You have been revived!</h1>";
		}
		else
		{
			$updateMP = $sql->updateMP($id);	
			echo "<h1>You are not dead!</h1>";	
		}











	 ?>


</center>











<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>













	<div class="footer">
	<div class="container">
		<ul class="social">
			<li><i class="fa"></i></li>
			<li><i class="fb"></i></li>
			<li><i class="fc"></i></li>
		</ul>
	<p>2014 Design by <a href="">GermZboy23</a></p>
	</div>
	
</div>
<!-- Footer Ends Here -->
</body>
</html>