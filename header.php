<?php
require "includes/dbh.inc.php";
/*
 * Vi gjorde denna som förra gången jag skapde bara en nav bar och istället för att lägga in den på 100 filer kan jag
 *  bara enkelt använda mig utav require "header.php"
 */
?>
<!DOCTYPE html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<meta name="description" content="NTI">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" href="style.css">
</head>
<body>

<header>
	<nav class="nav-header-main">
		<a class="header-logo" href="index.php">
			<img src="img/logo.png" alt="NTI LOGO">
		</a>
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="libary.php">Libary</a></li>
		</ul>
	</nav>
</header>