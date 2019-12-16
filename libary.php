<?php
require "header.php";
 // Felhantering, som visas i HTML, mer info finns under index.php
    if (isset($_GET["success"])) {
            if ($_GET["success"] == "moviedelete") {
              echo '<p class="signuperror">Movie Deleted!</p>';
            }
          }
// Vi behöver inget perp statment här eftersom det finns inte user input, så man kan inte dra in information genom
// denna.
$sql = "SELECT idMovie, idCategory, idTitle, idDirector, idYear FROM movielib";
    //Frågar databasen om allting stämmer, den gör en query.
$result = mysqli_query($conn, $sql);
// Här får vi reda på hur många rows vi har i databasen
$resultCheck = mysqli_num_rows($result);
// Om vi har mer än 0 rows i jatabasen ska vi visa koden nedan för, vilket är koden som visar tablerna.
if ($resultCheck > 0) {
    // För att tabel information som står längst upp inte ska visa sig mer än en gång sätter vi in den innan vi gör
    // while, det gör så att all information från databasen kommer in till samma html TABLE
	echo "<table class='main-table'><tr><th>Title</th><th>Director</th><th>Year</th><th>Category</th></tr>";
	// Så här har vi en while loop som går igenom alla rows, som finns i databasen och för varje row som hittas så
    // utförs echo koden, vilket betyder att alla rows i databasen får sin egen row i HTML!
	while ($row = mysqli_fetch_assoc($result)) {
		    echo "<tr>";
            	        echo "<td>" . $row["idTitle"] . "</td>";
            	        echo "<td>" . $row["idDirector"] . "</td>";
            	        echo "<td>" . $row["idYear"] . "</td>";
            	        echo "<td>" . $row["idCategory"] . "</td>";
		                echo "<td><a href='edit.inc.php?error=editsubmit&id=".$row['idMovie']."'>Edit</a></td>";
                        echo "<td><a href='/includes/delete.inc.php?error=deletesubmit&id=".$row['idMovie']."'>Delete</a></td>";

          echo "</tr>";
	}
}
// Om vi inte har några rows i databasen så lägger vi in denna text.
else {
	echo "There are no movies in this libary!";
}
// Här stänger vi anslutningen till databasen, den ska inte vara öppen det har med säkerhet att göra.
mysqli_close($conn);
?>
</body>
</html>
