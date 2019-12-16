<?php
require '../header.php';
if (isset($_POST['edit-submit'])) {
	require "dbh.inc.php";
	$id = $_POST['idMovie'];
	$category = $_POST['idCategory'];
	$title = $_POST['idTitle'];
	$director = $_POST['idDirector'];
	$year = $_POST['idYear'];
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
		$sql = "UPDATE movielib SET idCategory=?, idTitle=?, idDirector=?, idYear=? WHERE idMovie=?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location:../index.php?error=sqlerror");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "sssss", $category, $title, $director, $year, $id);
			mysqli_stmt_execute($stmt);
			header("Location:../index.php?submit=success");

		}
	}
	if (mysqli_query($conn, $sql)) {
		mysqli_close($conn);
		header('Location: ../libary.php?edit=success'); //If book.php is your main page where you list your all
		// records
		exit;
	} else {
		echo "Error deleting record";

	}
}
else {
				header("Location: ../index.php");
				exit();
			}