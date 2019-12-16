<?php

if (isset($_GET["error"])) {
	if ($_GET["error"] == "deletesubmit") {

		require 'dbh.inc.php';


		$id = $_GET['id'];


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