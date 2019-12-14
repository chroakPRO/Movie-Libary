<?php
// Denna isset är lite annorlunda tillskillnad från det vanliga, eftersom vi kunde inte skicka en post request genom
// en herf knapp var vi tvungen att lägga in en GET i href knappen, och det är den vi hämtar här återigen det här har
// med säkerhet att göra, vi vill inte att någon ska kunna gå in på ip/includes/delete.inc.php utan att trycka på
// knappen delete.
if (isset($_GET["error"])) {
	if ($_GET["error"] == "deletesubmit") {
		require 'dbh.inc.php';
// Lär mer om detta under edit.inc.php
		$id = $_GET['id'];
// Vi använder utav en prep statment ihop med DELETE, vi behöver bara ta bort ifrån movielib, eftersom moviecat är
// ett statiskt table, så vi ändrar aldrig någonting ifrån moviecat vi SELECT du kan läsa mer om prep statment under
// edit.inc.ph
		$sql = "DELETE FROM movielib WHERE idMovie = ?;";
		$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location:../index.php?error=sqlerror");
				exit();
			} else {
				mysqli_stmt_bind_param($stmt, "s", $id);
				mysqli_stmt_execute($stmt);
				header("Location:../libary.php?success=moviedelete");
			}
		// Här säger tittar vi om allting gick, så om vi kunde ansluta och utföra SQL kommandet så för den oss vidare
		// till libary.php
		if (mysqli_query($conn, $sql)) {
			mysqli_close($conn);
			header('Location: ../libary.php'); //If book.php is your main page where you list your all records
			exit;
		} else {
			echo "Error deleting record";
		}
	}
}
else {
	header("Location: ../libary.php?error=usneakybastard");
	exit();
}