<?php
/* Här har vi en av säkerhetsåtgärderna som jag skriver om.
Allting i dokumentet går under detta if statement, så om man inte har tryckt på knappen,
'edit' Så kommer ingen kod att köras förutom det som står i else längst ner.
Vilket kommer att skicka tillbaka en till libary.php  */
if (isset($_GET["error"])) {
if ($_GET["error"] == "editsubmit") {
	include 'header.php';
// Detta kommer ifrån libary.php titta där för att få mer information, men vi fångar in en GET request som
// som har id, och vi sätter ett var bakom den så vi kan enkelt använda den här igen.
// Men för att förstå det som står här går jag igenom det lite snabbt, när jag trycker på edit på libary.php så har
// den specifka rowen jag tryckte på ett ID, och det specifika idet tar jag här, för att kunna manipulerar bara en
// row istället för att ändra alla rows.
	$id = $_GET['id'];
// Här väljer vi alla rows från movielib, jag använder mig inte utav * eftersom det är inte speciellt säkert eller
// bra för databasen, det är något man ska undvika, sen kör jag prep statment vilket du kan se genom ? efter idMovie.
	$sql = "SELECT idMovie, idCategory, idTitle, idDirector, idYear FROM movielib WHERE idMovie = ?";
// Vi initierar anslutningen.
	$stmt = mysqli_stmt_init($conn);
// Som jag skrivit tidigare måste man alltid titta om något är fel innan man utför kod.
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		// Fungerar inte initationen eller att det inte går att ansluta till databasen så skickar vi felet error=sqlerror
		header("Location: index.php?error=sqlerror");
		exit();
	} else {
		/* Här bestämmer vi vad vi ska sätta in efter idMovie=? under ?, "s" står för string och $id står för en
	var, som vi definerat längst upp i filen, hade vi tillexempel vilja titta efter idMovie  ocb idTitle hade vi
		haft "ss", $id, $title Vi kommer få exempel på detta lite senare.
	*/
		mysqli_stmt_bind_param($stmt, "s", $id);
		// Vi kör sedan vårat statment, vi har ju gjort så att $stmt, innehåller databas annslutingen och SQL templaten.
		mysqli_stmt_execute($stmt);
		// Vi hämtar information och håller den i $result
		$result = mysqli_stmt_get_result($stmt);
		/* Här gör vi samma sak som förut, men eftersom vi vet att det bara kommer vara en row, behvöver inte köra ett
		 while command. Vi behöver inte heller titta om detta är sant eftersom vi gör det på libary, vi kommer inte kunna
		 trycka edit om det inte finns något att edita, så vi kan köra koden utan ett if kommand.
		Så information som finns på rowen i databasen är sparad i $row */
		$row = mysqli_fetch_assoc($result);
	}
	?>
<?php
	echo "<form action='includes/edit.inc2.php' method='post'>";
	echo "Here you can edit the movie!";
	echo "<div style=\"text-align: center; width: 100%;\">";
	echo "<div style=\"margin: 0 auto; width:100px; text-align:left;\">";
	echo "<br><br><br>";
	echo "Category<br>";
	echo "<input type='radio' name='idCategory' value='Thriller'>Thriller</td><br>";
	echo "<input type='radio' name='idCategory' value='Romantic'>Romantic</td><br>";
	echo "<input type='radio' name='idCategory' value='Comedy'>Comedy</td><br>";
	echo "<input type='radio' name='idCategory' value='Adventure'>Adventure</td><br>";
	echo "<input type='radio' name='idCategory' value='Action'>Action</td><br><br><br>";
	echo "</div>";
	echo "<div class='form-signup'>";
	// det är så här använder vi $row och sen tablename för att dra ut information från databasen och visa den i HTML
	echo "<input type='hidden' name='idMovie' value=" . $row['idMovie'] . "></td>";
	echo "Title: <input type='text' name='idTitle' value=" . $row['idTitle'] . "></td><br>";
	echo "Director: <input type='text' name='idDirector' value=" . $row['idDirector'] . "></td><br>";
	echo "Year: <input type='text' name='idYear' value=" . $row['idYear'] . "></td><br>";
	echo "<button type='submit' name='edit-submit'>Submit</button>";
	echo "</form>";
	echo "</div>";
}}
else {
	// Om användare inte har tryckt på edit inne på libary.php så skickas de iväg, like a sneaky bastard.
	header("Location: ../libary.php?error=usneakybastard");
	exit();
}



