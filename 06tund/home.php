<?php
  require("../../../configVP.php");
  require("functions_main.php");  
  require("functions_user.php");
  $database = "if19_mirjam_pe_1";
  
  //kui pole sisseloginud
  if(!isset($_SESSION["userID"])) {
	  //siis jõuga sisselogimise lehele
	  header("Location: page.php");
	  exit();
  }
  
  //väljalogimie
  if(isset($_GET["Logout"])){
	  session_destroy();
	  header("Location: page.php");
	  exit();
  }
  
  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
  
  //lisame lehe päise
  //require("header.php");
 
?>


<body>
  <?php
    echo "<h1>" .$userName ." PHP #6 07.10.2019</h1>";
  ?>
  <p>Antud leht on loodud koolis õppetöö raames ja ei sisalda tõsiseltvõetavat sisu!</p>
  <hr>
  <p><a href="?Logout=1">Logi välja!</a> <a href="userprofile.php">Kasutajaprofiil</a></p>
  <?php
  //lisame lehe jaluse
  require("footer.php");
  ?>