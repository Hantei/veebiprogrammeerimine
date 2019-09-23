<?php
 //globaalsed muutujad on väljaspool funktsiooni
  require("../../../configVP.php");
  $userName = "Mirjam Petti";
  $database = "if19_mirjam_pe_1";
  require("functions_film.php");
  
  //pannakse funktsioon käima (sama nimi on aga pole sama muutuja)
  $filmInfoHTML = readAllFilms();
  //lisame lehe päise
  require("header.php");
?>


<body>
  <?php
    echo "<h1>" .$userName ." Filmid via SQL 23.09.2019</h1>";
  ?>
  <p>Antud leht on loodud koolis õppetöö raames ja ei sisalda tõsiseltvõetavat sisu!</p>
  <hr>
  <h2>Eesti filmid</h2>
  <p>Praegu on andmebaasis järgmised filmid:</p>
  <?php
  echo $filmInfoHTML;
  //echo "Server: " .$serverHost .", kasutaja: " .$serverUsername;
  //lisame lehe jaluse
  require("footer.php");
  ?>