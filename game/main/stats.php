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

		<div id="body">
			<div>
				<div>
					<div class="games">
						<div class="content">
							<h3>Character Information</h3>
							<ul>
								<li>
									<a href="#" class="figure"><img src="images1/char.jpg" alt=""></a><span><a href="#"><center>Revenge is in our hands</center></a></span>
								</li>
								<li>
									<a href="#" class="figure"><img src="images1/slide4.png" alt=""></a> <span><a href="#">HP: <?php echo $result['HP']; ?> / MaxHP: <?php echo $result['MaxHP']; ?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMP: <?php echo $result['MP']; ?> / MaxMP: <?php echo $result['MaxMP']; ?></a></span>
								</li>
							</ul>
						</div>
						<div class="aside">
							<h3>Stats</h3>
							<ul><center>
								<li><br><br><br><br>
									<a href="#" class="figure"><img src="images1/stats/strength.gif" alt=""></a>
									<br><br><br>
									<span><a href="#">Strength: <?php echo $result['Strength'] ?> </a></span>
								</li>
								<li><br><br><br><br>
									<a href="#" class="figure"><img src="images1/stats/constitution.gif" alt=""></a>
									<br><br><br>
									<span><a href="#">Constitution: <?php echo $result['Constitution']; ?></a></span>
								</li>
								<li><br><br><br><br>
									<a href="#" class="figure"><img src="images1/stats/dexterity.gif" alt=""></a>
									<br><br><br>
									<span><a href="#">Dexterity: <?php echo $result['Dexterity']; ?></a></span>
								</li>
								<li><br><br><br><br>
									<a href="#" class="figure"><img src="images1/stats/wisdom.gif" alt=""></a>
									<br><br><br>
									<span><a href="#">Intelligence: <?php echo $result['Intelligence'] ?></a></span>
								</li>
								<li><br><br><br><br>
									<a href="#" class="figure"><img src="images1/stats/hp.gif" alt=""></a>
									<br><br><br>
									<span><a href="#"><?php echo $result['Items'] ?> Items Owned</a></span>
								</li>
								<li><br><br><br><br>
									<a href="#" class="figure"><img src="images1/stats/gold.gif" alt=""></a>
									<br><br><br>
									<span><a href="#">Gold: <?php echo $result['Gold'] ?></a></span>
								</li>
								</center>
							</ul>
						</div>
					
					</div>
				</div>
			</div>
		</div>

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