<?php    
	//funktsiooni sees on lokaalsed muutujad, $GLOBALS[] võtab globaalsetest lokaalse asemel
	function readAllFilms() {
	  //loeme andmebaasist
	  //loome andmebaasiga ühenduse (näiteks $conn) - kõigepealt server, siis kasutajanimi, siis parool ja lõpuks andmebaasi
	  $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	  mysqli_set_charset( $conn, 'utf8');
	  //valmistame ette päringu
	  $stmt = $conn->prepare("SELECT pealkiri, aasta, kestus, zanr, tootja, lavastaja FROM film");
	  //kui midagi on andmebaasist tulemas, tuleb teha bind_result, sest see seob saadava tulemuse muutujaga, järjekord on oluline, peab olema sama mis $conn
	  $stmt->bind_result($filmTitle, $filmYear, $filmDuration, $filmGenre, $filmCompany, $filmDirector);
	  //käivitame SQL päringu
	  $stmt->execute();
	  $filmInfoHTML = '<table style="width:50%" border="1"><tr bgcolor="#C0C0C0">';
	  $filmInfoHTML .= '<th>Filmi nimi</th><th>Žanr</th><th>Lavastaja</th><th>Kestus</th><th>Tootja</th><th>Tootmisaasta</th>';
	  $filmInfoHTML .= '</tr>';
	  while($stmt->fetch()){
		  $filmInfoHTML .= '<tr><td>' .$filmTitle .'</td><td>';
		  $filmInfoHTML .= $filmGenre .'</td><td>';
		  $filmInfoHTML .= $filmDirector .'</td><td>';
		  if ($filmDuration < 60){
			$filmInfoHTML .= $filmDuration ." minutit</td><td>";
		  }elseif (round($filmDuration/60) < 2){
			$filmInfoHTML .=  round($filmDuration/60) ." tund";
			  if ($filmDuration%60 != 0){
				$filmInfoHTML .=  " ja " .round($filmDuration%60) ." minutit</td><td>";
			  }else {
				$filmInfoHTML .=  "</td><td>";
			  }
		  }else {
			$filmInfoHTML .=  round($filmDuration/60) ." tundi";
			  if ($filmDuration%60 != 0){
				$filmInfoHTML .=  " ja " .round($filmDuration%60) ." minutit</td><td>";
			  }else {
				$filmInfoHTML .=  "</td><td>";
			  }
		  }
		  $filmInfoHTML .= $filmCompany .'</td><td>';
		  $filmInfoHTML .= $filmYear .'</td></tr>';   		  
	  }
	  $filmInfoHTML .= '</table>';
	  //echo $filmTitle;	  
	  //sulgeme ühenduse
	  $stmt->close();
	  $conn->close();
	  //väljastan väärtuse
	  return $filmInfoHTML;
	} 
	
	function readSomeFilms() {
	  $maxYear = date("Y") - 50;
	  $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	  mysqli_set_charset( $conn, 'utf8');
	  $stmt = $conn->prepare("SELECT pealkiri, aasta, kestus, zanr, tootja, lavastaja FROM film WHERE aasta < ? ORDER BY aasta");
	  $stmt->bind_result($filmTitle, $filmYear, $filmDuration, $filmGenre, $filmCompany, $filmDirector);
	  $stmt->bind_param("i", $maxYear);
	  $stmt->execute();
	  $someFilmInfoHTML = '<table style="width:50%" border="1"><tr bgcolor="#C0C0C0">';
	  $someFilmInfoHTML .= '<th>Filmi nimi</th><th>Žanr</th><th>Lavastaja</th><th>Kestus</th><th>Tootja</th><th>Tootmisaasta</th>';
	  $someFilmInfoHTML .= '</tr>';
	  while($stmt->fetch()){
		  $someFilmInfoHTML .= '<tr><td>' .$filmTitle .'</td><td>';
		  $someFilmInfoHTML .= $filmGenre .'</td><td>';
		  $someFilmInfoHTML .= $filmDirector .'</td><td>';
		  if ($filmDuration < 60){
			$someFilmInfoHTML .= $filmDuration ." minutit</td><td>";
		  }elseif (round($filmDuration/60) < 2){
			$someFilmInfoHTML .=  round($filmDuration/60) ." tund";
			  if ($filmDuration%60 != 0){
				$someFilmInfoHTML .=  " ja " .round($filmDuration%60) ." minutit</td><td>";
			  }else {
				$someFilmInfoHTML .=  "</td><td>";
			  }
		  }else {
			$someFilmInfoHTML .=  round($filmDuration/60) ." tundi";
			  if ($filmDuration%60 != 0){
				$someFilmInfoHTML .=  " ja " .round($filmDuration%60) ." minutit</td><td>";
			  }else {
				$someFilmInfoHTML .=  "</td><td>";
			  }
		  }
		  $someFilmInfoHTML .= $filmCompany .'</td><td>';
		  $someFilmInfoHTML .= $filmYear .'</td></tr>';   		  
	  }
	  $someFilmInfoHTML .= '</table>';
	  $stmt->close();
	  $conn->close();
	  return $someFilmInfoHTML;
	}
	
	function saveFilmInfo($filmTitle, $filmYear, $filmDuration, $filmGenre, $filmCompany, $filmDirector) {
	  $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	  $stmt = $conn->prepare("INSERT INTO film (pealkiri, aasta, kestus, zanr, tootja, lavastaja) VALUES(?,?,?,?,?,?)");
	  echo $conn->error;
	  //andmetüübid s-string i-integer d-decimal
	  $stmt->bind_param("siisss", $filmTitle, $filmYear, $filmDuration, $filmGenre, $filmCompany, $filmDirector);
	  $stmt->execute();
	  $stmt->close();
	  $conn->close();
	}
?>