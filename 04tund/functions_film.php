<?php    
	//funktsiooni sees on lokaalsed muutujad, $GLOBALS[] võtab globaalsetest lokaalse asemel
	function readAllFilms() {
	  //loeme andmebaasist
	  //loome andmebaasiga ühenduse (näiteks $conn) - kõigepealt server, siis kasutajanimi, siis parool ja lõpuks andmebaasi
	  $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	  //valmistame ette päringu
	  $stmt = $conn->prepare("SELECT pealkiri, aasta FROM film");
	  //kui midagi on andmebaasist tulemas, tuleb teha bind_result, sest see seob saadava tulemuse muutujaga, järjekord on oluline, peab olema sama mis $conn
	  $stmt->bind_result($filmTitle, $filmYear);
	  //käivitame SQL päringu
	  $stmt->execute();
	  $filmInfoHTML = null;
	  while($stmt->fetch()){
		  $filmInfoHTML .= "<h3>" .$filmTitle ."</h3>";
		  $filmInfoHTML .= "<p>Tootmisaasta: " .$filmYear .".</p>";
		//echo $filmTitle;	  
	  }
	  //sulgeme ühenduse
	  $stmt->close();
	  $conn->close();
	  //väljastan väärtuse
	  return $filmInfoHTML;
	}
?>