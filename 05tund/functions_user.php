<?php
	function signUp($name, $surname, $email, $gender, $birthDate, $password) {
		$notice = null;
		$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $conn->prepare("INSERT INTO vpusers3 (firstname, lastname, birthdate, gender, email, password) VALUES (?,?,?,?,?,?)");
		echo $conn->error;
		
		//valmistame parooli salvestamiseks ette
		$options = ["cost" => 12, "salt" => substr(sha1(rand()), 0, 22)];
		$pwdhash = password_hash($password, PASSWORD_BCRYPT, $options);
		
		$stmt->bind_param("sssiss", $name, $surname, $birthDate, $gender, $email, $pwdhash);

		if($stmt->execute()) {
			$notice = "Uue kasutaja salvestamine õnnestus!";
		}else {
			$notice = "kasutaja salvestamisel tekkis tehniline viga: " .$stmt->error;
		}

		$stmt->close();
		$conn->close();
		return $notice;
	}
	
	function signIn($email, $password) {
		$notice = null;
		$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $conn->prepare("SELECT password FROM vpusers3 WHERE email=?");
		echo  $conn->error;
		$stmt->bind_param("s", $email);
		$stmt->bind_result($passwordFromDB);
		if($stmt->execute()){
			if($stmt->fetch()) {
			//parooli õigsust kontrollib:
				if(password_verify($password, $passwordFromDB)) {
					$stmt->close();
					$stmt = $conn->prepare("SELECT firstname, lastname FROM vpusers3 WHERE email=?");
					echo $conn->error;
					$stmt->bind_param("s", $email);
					$stmt->bind_result($firstnameFromDB, $lastnameFromDB);
					$stmt->execute();
					$stmt->fetch();
					$notice = " Sisselogimine õnnestus! Tere " .$firstnameFromDB ." " .$lastnameFromDB .".";
				}else {
					$notice = " Vale salasõna.";
				}
			}else {
				$notice = " Sellist kasutajat (" .$email .") ei eksisteeri!";
			}
		}else {
			$notice = " Sisse logimisel tekkis viga: " .$stmt->error;
		}
		$stmt->close();
		$conn->close();
		return $notice;	
	}

?>