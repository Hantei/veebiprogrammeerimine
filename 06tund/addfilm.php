<?php
// KODUS - sql päringud ja näidake veebilehel, nt 10 aastat vanad filmid, või ainult kindla aastaga jne + salvestada film title year jne muutujasse, ja kui midagi on puudu (nimi) siis salvestust ei tehta, error võiks tulla siis, uus muutuja mis sisaldab infot kas kõik läks hästi. salvestage valuesse kui salvestus ei õnnestu, ehk lisada value formi koos php koodiga
 //globaalsed muutujad on väljaspool funktsiooni
  require("../../../configVP.php");
  $userName = "Mirjam Petti";
  $database = "if19_mirjam_pe_1";
  require("functions_film.php");
  $errormsg = '<p style="color:red;">Sisestage vähemalt filmi pealkiri!</p>';
  //defineerin tühjad väärtused
  $filmTitleInserted = null;
  $filmYearInserted = 2019;
  $filmDurationInserted = 80;
  $filmGenreInserted = null;
  $filmCompanyInserted = null;
  $filmDirectorInserted = null;

  //lisame lehe päise
  require("header.php");
?>


<body>
  <?php
    echo "<h1>" .$userName ." Tund #4 Filmid via SQL 28.09.2019</h1>";
	if(isset($_POST["submitFilm"]) and (empty($_POST["filmTitle"])) ){
		$ok = false;
		if (isset($_POST["filmYear"])) {
			$filmYearInserted = htmlentities($_POST["filmYear"]);
		}
		if (isset($_POST["filmDuration"])) {
			$filmDurationInserted = htmlentities($_POST["filmDuration"]);
		}
		if (isset($_POST["filmGenre"])) {
			$filmGenreInserted = htmlentities($_POST["filmGenre"]);
		}
		if (isset($_POST["filmCompany"])) {
			$filmCompanyInserted = htmlentities($_POST["filmCompany"]);
		}
		if (isset($_POST["filmDirector"])) {
			$filmDirectorInserted = htmlentities($_POST["filmDirector"]);
		}
	}else {
		$ok = true;
		//kui on nuppu vajutatud
		if(isset($_POST["submitFilm"])){
		//salvestame ainult siis kui vähemalt pealkiri on olemas
			if(!empty($_POST["filmTitle"])) {
				saveFilmInfo($_POST["filmTitle"], $_POST["filmYear"], $_POST["filmDuration"], $_POST["filmGenre"], $_POST["filmCompany"], $_POST["filmDirector"]);
			}
		unset($_POST);
	}
  }
  ?>
  <p>Antud leht on loodud koolis õppetöö raames ja ei sisalda tõsiseltvõetavat sisu!</p>
  <hr>
  <h2>Eesti filmid, lisame uue</h2>
  <p>Täida kõik failid ja lisa film andmebaasi: </p>
  <form accept-charset="UTF-8" method="POST">
    <label>Sisesta pealkiri: </label><input type="text" value="<?php echo $filmTitleInserted; ?>" name="filmTitle">
	<br>
	<label>Filmi tootmisaasta: </label><input type="number" min="1912" max="2019" value="<?php echo $filmYearInserted; ?>" name="filmYear">
	<br>
	<label>Filmi kestus (min): </label><input type="number" min="1" max="300" value="<?php echo $filmDurationInserted; ?>" name="filmDuration">
	<br>
	<label>Filmi žanr: </label><input type="text" value="<?php echo $filmGenreInserted; ?>" name="filmGenre">
	<br>
	<label>Filmi tootja: </label><input type="text" value="<?php echo $filmCompanyInserted; ?>" name="filmCompany">
	<br>
	<label>Filmi lavastaja: </label><input type="text" value="<?php echo $filmDirectorInserted; ?>" name="filmDirector">
	<br>
	<input type="submit" value="Salvesta filmi info" name="submitFilm">
  </form>
  <?php
  if (!$ok) {
	  echo $errormsg;
  }
    //var_dump($_POST);
  //echo $filmInfoHTML;
  //echo "Server: " .$serverHost .", kasutaja: " .$serverUsername;
  //lisame lehe jaluse
  require("footer.php");
  ?>