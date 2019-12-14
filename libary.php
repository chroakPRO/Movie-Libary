<?php
require "header.php";
 // Felhantering, som visas i HTML, mer info finns under index.php
    if (isset($_GET["success"])) {
            if ($_GET["success"] == "moviedelete") {
              echo '<p class="signuperror">Movie Deleted!</p>';
            }
          }
/* Vi behöver inget perp statment här eftersom det finns inte user input, så man kan inte dra in information genom
denna.  Vi använder oss utav inner join här, eftersom filmens kategori ligger i ett tabel som heter moviecat, och
resten ligger i ett tabel som heter movielib, men båda två har en row some heter idCategory som är en int(1) och
varje id i idCategory motsvara en genre, för när användaren använder sig utav index.php, så lägger bara in i movielib
 inte moviecat, vilket fungerar eftersom de lägger in ett id i movielib som motsvarar en genre i moviecat.*/
$sql = "SELECT idMovie, idTitle, idDirector, idYear, idGenre FROM movielib INNER JOIN moviecat on movielib.idCategory = moviecat.idCategory";
    //Frågar databasen om allting stämmer, den gör en query.
$result = mysqli_query($conn, $sql);
// Här får vi reda på hur många rows vi har i databasen
$resultCheck = mysqli_num_rows($result);
// Om vi har mer än 0 rows i databasen ska vi visa koden nedan för, vilket är koden som visar tablerna.
if ($resultCheck > 0) {
    // För att tabel information som står längst upp inte ska visa sig mer än en gång sätter vi in den innan vi gör
    // while, det gör så att all information från databasen kommer in till samma html TABLE
	echo "<table class='main-table'><tr><th>Title</th><th>Director</th><th>Year</th><th>Category</th></tr>";
	// Så här har vi en while loop som går igenom alla rows, som finns i databasen och för varje row som hittas så
    // utförs echo koden, vilket betyder att alla rows i databasen får sin egen row i HTML!
	while ($row = mysqli_fetch_assoc($result)) {
		    echo "<tr>";
		    // Här skriver vi ut information ifrån databasen.
            	        echo "<td>" . $row["idTitle"] . "</td>";
            	        echo "<td>" . $row["idDirector"] . "</td>";
            	        echo "<td>" . $row["idYear"] . "</td>";
            	        echo "<td>" . $row["idGenre"] . "</td>";
            	        /* Här nedan är för de två knapparna man ser inne på libary.php, en för
            	        edit och en för delete,
            	         jag valde att använda mig utav a href knappar istället för inputs, eftersom det är mycket
            	        mer clean än att använda sig utav en form, som har input, som du ser så har jag också två
            	        olika id's efter php?, första (error=deletesubmit) är för att kunna skicka globala post
            	        request, som jag kan använda för isset på delete.inc.php det har med säkerhet att göra. Den
            	        andra (id=$row['idMovie']) har med att jag vill skicka id'n på raden jag väljer. Så om jag
            	        väljer  titantic ska inte Django unchained skickas, och det gör vi enkelt med en href
            	        knapp, lite svårare med en form och en anledning varför vi använder oss utav en href knapp.*/
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
