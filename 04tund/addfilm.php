<?php
// KODUS - sql päringud ja näidake veebilehel, nt 10 aastat vanad filmid, või ainult kindla aastaga jne + salvestada film title year jne muutujasse, ja kui midagi on puudu (nimi) siis salvestust ei tehta, error võiks tulla siis, uus muutuja mis sisaldab infot kas kõik läks hästi. salvestage valuesse kui salvestus ei õnnestu, ehk lisada value formi koos php koodiga
 //globaalsed muutujad on väljaspool funktsiooni
  require("../../../configVP.php");
  $userName = "Mirjam Petti";
  $database = "if19_mirjam_pe_1";
  require("functions_film.php");
  
  //var_dump($_POST);
  //kui on nuppu vajutatud
  if(isset($_POST["submitFilm"])){
	//salvestame ainult siis kui vähemalt pealkiri on olemas
	if(!empty($_POST["filmTitle"])) {
	  saveFilmInfo($_POST["filmTitle"], $_POST["filmYear"], $_POST["filmDuration"], $_POST["filmGenre"], $_POST["filmCompany"], $_POST["filmDirector"]);
	}
  }
  
  //lisame lehe päise
  require("header.php");
?>


<body>
  <?php
    echo "<h1>" .$userName ." Filmid via SQL 23.09.2019</h1>";
  ?>
  <p>Antud leht on loodud koolis õppetöö raames ja ei sisalda tõsiseltvõetavat sisu!</p>
  <hr>
  <h2>Eesti filmid, lisame uue</h2>
  <p>Täida kõik failid ja lisa film andmebaasi: </p>
  <form method="POST">
    <label>Sisesta pealkiri: </label><input type="text" name="filmTitle">
	<br>
	<label>Filmi tootmisaasta: </label><input type="number" min="1912" max="2019" value="2019" name="filmYear">
	<br>
	<label>Filmi kestus (min): </label><input type="number" min="1" max="300" value="80" name="filmDuration">
	<br>
	<label>Filmi žanr: </label><input type="text" name="filmGenre">
	<br>
	<label>Filmi tootja: </label><input type="text" name="filmCompany">
	<br>
	<label>Filmi lavastaja: </label><input type="text" value="<?php echo $filmDirectorInserted; ?> name="filmDirector">
	<br>
	<input type="submit" value="Salvesta filmi info" name="submitFilm">
  </form>
  <?php
  //echo $filmInfoHTML;
  //echo "Server: " .$serverHost .", kasutaja: " .$serverUsername;
  //lisame lehe jaluse
  require("footer.php");
  ?>