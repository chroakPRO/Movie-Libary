<?ph
require '../header.php';
// Läs mer om detta under edit.inc.php
if (isset($_POST['edit-submit'])) {
	require "dbh.inc.php";
	// Här hämtar vi information ifrån edit.inc.php
	$id = $_POST['idMovie'];
	$category = $_POST['idCategory'];
	$title = $_POST['idTitle'];
	$director = $_POST['idDirector'];
	$year = $_POST['idYear'];
// Läser mer om detta under movielib.inc.php
	if (empty($title) || empty($director) || empty($year) || empty($category)) {
		header("Location: /edit.inc.php?error=emptyfields");
		exit();
	} else if (!preg_match("/^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$/", $title)) {
		header("Location: ../index.php?error=invalidtitle");
		exit();
	} else if (!preg_match("/^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$/", $director)) {
		header("Location: ../index.php?error=invaliddirector");
		exit();
	} else if (!preg_match("/^[0-9]*$/", $year)) {
		header("Location: ../index.php?error=invalidyear");
		exit();
	}  else {
		// Här måste vi använda oss utav UPDATE istället för insert eftersom vi updaterar databasen, skulle vi
		// använda oss utav insert skulle vi bara göra ett ny inlägg, och inte ändra den gamla, vi använder oss
		// självklart av ett prep statement, mer om detta kan du läsa under, edit.inc.php
		$sql = "UPDATE movielib SET idCategory=?, idTitle=?, idDirector=?, idYear=? WHERE idMovie=?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location:../index.php?error=sqlerror");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "sssss", $category, $title, $director, $year, $id);
			mysqli_stmt_execute($stmt);
		}
	}
	// Här säger tittar vi om allting gick, så om vi kunde ansluta och utföra SQL kommandet så för den oss vidare
	// till libary.php
	if (mysqli_query($conn, $sql)) {
		mysqli_close($conn);
		header('Location: ../libary.php?edit=success'); //If book.php is your main page where you list your all
		// records
		exit;
	} else {
		// Fungerade inte, får vi upp detta i HTML form!
		echo "Error deleting record";
	}
}
// Vi blir skickade till index.php om, isset inte fungerar.
else {
				header("Location: ../index.php");
				exit();
			}