<?php
  $userName = "Mirjam Petti";
  $photoDir = "../photos/";
  $picFileTypes = ["image/jpeg", "image/png"];
  $dayNow = date("w");
  $hourNow = date("H");
  $monthNow = date("n");
  //kuu ja nädalapäevade massiivid
  $weekDaysET = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
  $monthsET = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
  //kuupäev
  $fullTimeNow = "<strong>" .$weekDaysET[$dayNow -1] ." - " .date("d. ") .$monthsET[$monthNow -1] .date(" Y H:i:s") ."</strong>";
  
  //lehe avamise ajal olnud tegevus
  $partOfDay = "hägune aeg";
  if(($hourNow >= 8 && $hourNow < 12) && ($dayNow == 1)){
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
?>


<body>
  <?php
    echo "<h1>" .$userName ." PHP #2 16.09.2019</h1>";
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
    echo "<p>Lehe avamise hetkel oli <strong>" .$partOfDay ."</strong>.</p><hr>";
    echo $randomImgHTML;
  //lisame lehe jaluse
  require("footer.php");
  ?>