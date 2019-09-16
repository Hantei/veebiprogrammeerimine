<?php
  $userName = "Mirjam Petti";
  $photoDir = "../photos/";
  $picFileTypes = ["image/jpeg", "image/png"];
  $fullTimeNow = date("d.m.Y H:i:s");
  $dayNow = date("w");
  $hourNow = date("H");
  
  $weekDaysET = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
  
  //$minuteNow = date("i");
  $partOfDay = "hägune aeg";
  if(($hourNow >= 8) && ($dayNow == 1)){
	$partOfDay = "veebiprogrammeerimise loeng";
  } elseif(($hourNow >= 12 && $hourNow < 16) && ($dayNow == 1)){
	$partOfDay = "interaktsioonidisaini praktikum";
  } elseif(($hourNow >= 8) && ($dayNow == 2)){
	$partOfDay = "programmeerimise aluste loeng";
  } elseif(($hourNow >= 12 && $hourNow < 14) && ($dayNow == 2)){
	$partOfDay = "andmebaaside projekteerimise loeng";
  } elseif(($hourNow >= 14 && $hourNow < 16) && ($dayNow > 1 && $dayNow < 6)){
	$partOfDay = "jaapani keele loeng";
  } else {
	$partOfDay = "loenguvaba aeg";
  }
  
  //info semestri kulgemise kohta
  $semesterStart = new DateTime("2019-9-2");
  $semesterEnd = new DateTime("2019-12-13");
  $semesterDuration = $semesterStart->diff($semesterEnd);
  $today = new DateTime("now");
  $fromSemesterStart = $semesterStart->diff($today);
  //var_dump($fromSemesterStart);
  $semesterInfoHTML = "<p>Siin peaks olema info semestri kulgemise kohta!</p>";
  $elapsedValue = $fromSemesterStart->format("%r%a");
  $durationValue = $semesterDuration->format("%r%a");
  //echo $testValue;
  //<meter min="0" max="155" value="33">Väärtus</meter>
  if($elapsedValue > 0){
	  $semesterInfoHTML = "<p>Semester on täies hoos: ";
	  $semesterInfoHTML .= '<meter min="0" max="' .$durationValue .'" ';
	  $semesterInfoHTML .= 'value="' .$elapsedValue .'">';
	  $semesterInfoHTML .= round( $elapsedValue / $durationValue * 100, 1) ."%";
	  $semesterInfoHTML .= "</meter>";
	  $semesterInfoHTML .= "</p>";
  }
  
  //foto lisamine lehele
  $allPhotos = [];
  $dirContent = array_slice(scandir($photoDir), 2);
  //var_dump($dirContent);
  foreach($dirContent as $file){
    $fileInfo = getImagesize($photoDir .$file);
	//var_dump($fileInfo);
	if(in_array($fileInfo["mime"], $picFileTypes) == true){
		array_push($allPhotos, $file);
	}
  }
  
  //var_dump($allPhotos);
  $picCount = count($allPhotos);
  $picNum = mt_rand(0, ($picCount - 1));
  //echo $allPhotos[$picNum];
  $photoFile = $photoDir .$allPhotos[$picNum];
  $randomImgHTML = '<img src="' .$photoFile .'" alt="TLÜ Terra õppehoone">';
  
  //lisame lehe päise
  require("header.php");
  
  //kodutöö - kõik php lehed algavad headeriga (require). header ümber teha phpks nt $headHTML = "blabla" ja lõpus on echo ja muutuja välja. footer lisaks samamoodi (loominguline). Kuu asemel eestikeelne sõna (massiiviga) + nädalapäev (ka massiivist). google php date (n) ja otsida day fo the week (mul olemas).
?>


<body>
  <?php
    echo "<h1>" .$userName ." HTML #2 16.09.2019</h1>";
  ?>
  <p>Antud leht on loodud koolis õppetöö raames ja ei sisalda tõsiseltvõetavat sisu!</p>
  <?php
    echo $semesterInfoHTML;
  ?>
  <hr>
  <p>Lehe avamise hetkel oli aeg: 
  <?php
   echo $fullTimeNow;
  ?>
  .</p>
  <?php
    echo "<p>Lehe avamise hetkel oli <strong>" .$partOfDay ."</strong>.</p>";
  ?>
  <hr>
  <?php
    echo $randomImgHTML;
  ?>
</body>
</html>