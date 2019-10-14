<?php
  require("../../../configVP.php");
  require("functions_main.php");  
  require("functions_user.php");
  $database = "if19_mirjam_pe_1";

  $mybgcolor = "#FFFFFF";
  $mytxtcolor = "#000000";
  $mydescription = null;
  $passwordError = null;
  $passwordError2 = null;
  $notice = null;
  
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
  $userid = $_SESSION["userID"];

	
  if(isset($_POST["submitProfile"])) {
	  if(!empty($_POST["description"])) {
		  $mydescription = test_input($_POST["description"]);
	  }else {
		$myProfileDesc = showMyDesc();
			if(!empty($myProfileDesc)){
				$mydescription = $myProfileDesc;
    }
	  }
	  if(!empty($_POST["bgcolor"])) {
		  $mybgcolor = $_POST["bgcolor"];
	  } 
	  if(!empty($_POST["txtcolor"])) {
		  $mytxtcolor = $_POST["txtcolor"];
	  } 
	  if(!empty($mydescription) and !empty($mybgcolor) and !empty($mytxtcolor)) {
		  $notice = createProfile($userid, $mydescription, $mybgcolor, $mytxtcolor);
	  }
  }
  
    if(isset($_POST["changePassword"])) {
	  if(empty($_POST["newPassword"])) {
		  $passwordError = " Palun sisesta uus salasõna!";
	  }else {
		  if($_POST["newPassword"] < 8){
			$passwordError = " Salasõna peab olema vähemalt 8 märki!";
		  }else{
			if(empty($_POST["newPassword2"])) {
				$passwordError2 = " Palun sisesta uus salasõna uuesti!";
			}else{
				if($_POST["newPassword"] != $_POST["newPassword2"]) {
				$passwordError2 = " Salasõnad ei ole ühesugused!";
				}else{
					if(empty ($passwordError) and empty ($passwordError2)){
						$notice = changePassword($userid, $_POST["newPassword"]);
					}
				}
			}
		  }
	  }
  }
  
  //lisame lehe päise
  require("header.php");
 
?>


<body>
  <?php
    echo "<h1>" .$userName ." PHP #6 07.10.2019</h1>";
  ?>
  <p>Antud leht on loodud koolis õppetöö raames ja ei sisalda tõsiseltvõetavat sisu!</p>
  <hr>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Minu kirjeldus</label><br>
	  <textarea rows="10" cols="80" name="description"><?php echo $mydescription; ?></textarea>
	  <br>
	  <label>Minu valitud taustavärv: </label><input name="bgcolor" type="color" value="<?php echo $mybgcolor; ?>"><br>
	  <label>Minu valitud tekstivärv: </label><input name="txtcolor" type="color" value="<?php echo $mytxtcolor; ?>"><br>
	  <input name="submitProfile" type="submit" value="Salvesta profiil"><span><?php echo $notice; ?></span>
	</form>
  <hr>
  <p>Muuda salasõna:</p>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Uus parool: </label><input name="newPassword" type="password"><?php echo $passwordError; ?><br>
	  <label>Uus parool uuesti: </label><input name="newPassword2" type="password"><?php echo $passwordError2; ?><br>
	  <input name="changePassword" type="submit" value="Muuda salasõna"><span><?php echo $notice; ?></span>
	</form>
  <hr>
  <p><a href="?Logout=1">Logi välja!</a></p>
  <?php
  //lisame lehe jaluse
  require("footer.php");
  ?>