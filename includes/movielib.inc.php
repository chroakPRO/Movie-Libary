<?php
//Titta varför vi gör så här under edit.inc.php
if (isset($_POST['movielib-submit'])) {
	// Här hämtar vi databasen!
	require "dbh.inc.php";
	// Här hämtar vi information ifrån index.php
	$category = $_POST['category'];
	$title = $_POST['title'];
	$director = $_POST['director'];
	$year = $_POST['year'];
	/* Det första man alltid ska göra innan man börjar köra den huvudsakliga koden är att leta
	efter fel.
	Det vi gör här är att vi sätter lite regler och parametrar för vad de får ha för lösenord etc.
	Här är också där vi skickar tillbaka information, låt säga att ditt lösenord, vill vi inte
	att användaren ska behöva skriva in användarnamnet, så vi skickar tillbaka användarnamnet till formen.
	Så användaren inte behöver skriva in användarnamnet igen.*/
	// Här tittar vi om alla fält är fyllda.
	if (empty($title) || empty($director) || empty($year)) {
		header("Location: ../index.php?error=emptyfields");
		exit();
		// Här använder vi oss utav regex för att bestämma vad användare får skriva in, detta är väldigt bra när det
		// kommer till SQL injektion eftersom vi tvingar användaren att bara använda olika tecken, så SQL injektion
		// blir svårare, i detta fall låter vi användare bara använda stora och små bokstäver samt siffror
	} else if (!preg_match("/^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$/", $title)) {
		header("Location: ../index.php?error=invalidtitle");
		exit();
		// Samma sak, små och stora bokstäver samt siffror
	} else if (!preg_match("/^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$/", $director)) {
		header("Location: ../index.php?error=invaliddirector");
		exit();
		// Här får de bara använda sig utav siffror eftersom de ska skriva år.
	} else if (!preg_match("/^[0-9]*$/", $year)) {
		header("Location: ../index.php?error=invalidyear");
		exit();
	} else {
		/*Här har vi ett till prep statment, som sätter in information i movielib, och tablerna som står efter,
		 vi skriver också i value att det är 4st värden vi vill sätta in i movielib, och ordningen efter movielib och
		 values står för vad som åker in vart.*/
		$sql = "INSERT INTO movielib (idCategory, idTitle, idDirector, idYear) value (?, ?, ?, ?);";
		$stmt = mysqli_stmt_init($conn);
		// Fungerar inte initationen eller att det inte går att ansluta till databasen så skickar vi felet error=sqlerror
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location:../index.php?error=sqlerror");
			exit();
		} else {
			// Läs mer om detta under edit.inc.php, men vi sätter in 4st values här istället för 1, och vi använder
			// oss utav var som vi skapade i toppen av sidan, med hjälp av post.
			mysqli_stmt_bind_param($stmt, "ssss", $category, $title, $director, $year);
			// vi utför prep statment
			mysqli_stmt_execute($stmt);
			// fungerar det skickar vi dom vidare till index.php
			header("Location:../index.php?success=moviesubmit");
		}
	}
	// Vi stänger vårat prep statment och databas anslutingen.
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}
else {
	//Skulle det vara så att de inte tryckte på knappen submit så blir de skickade till index.php.
	header("Location: ../index.php");
	exit();
}

