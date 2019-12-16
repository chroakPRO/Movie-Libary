<?php
 require "includes/dbh.inc.php";
 require "header.php";
?>


<main>
    <div class="body-form">



        <?php
		/* Här har vi  felhantering i PHP form som visar sig i HTML. När försöker att sign up och
	någonting är fel, så skickas en data i GET, låt säga att du har skrivit ett
	felaktigt titel vilket vi ser genom (movielib..inc.php) du blir då
	vidarebefodrad till "Header("Location: ../index.php?error=invalidtitle");"
	vi kan då se att du har en data som säger Error=invalidtitle,
	vi läser sedan all data som kommer in och med hjälp av if/else kod kan vi ändra HTML,
	så eftersom error är lika med invalidtitle,
	så kommer en p klass att skapas som säger ogiltigt title! */
            if (isset($_GET['error'])) {
				if ($_GET['error'] == "emptyfields") {
					echo '<p class="signuperror">All Fields Needs To Be Filled!</p>';
				}

			else
				if ($_GET["error"] == "invalidtitle") {
					echo '<p class="signuperror">Invalid Title!</p>';
				} else if ($_GET["error"] == "invaliddirector") {
					echo '<p class="signuperror">Invalid Director!</p>';
				} else if ($_GET["error"] == "invalidyear") {
					echo '<p class="signuperror">Invalid Year!</p>';
				}
			}

            else if(isset($_GET['success'])) {
                if ($_GET['success'] == 'moviesubmit') {
					echo '<p class="signupsuccess">Submit Successful!</p>';
                }
            }

// Nedanför har du tråkig HTML och CSS kod.
        ?>

<label></label>
        <section>
<p> HERE U SUBMIT THE MOVIE!</p>
        <form action="includes/movielib.inc.php" method="post">


            <div style="text-align: center; width: 100%;">
                <div style="margin: 0 auto; width:100px; text-align:left;">
                    <input type="radio" class="form-radio" name="category" value="1"checked>Thriller
                    <br />
                    <input type="radio" class="form-radio" name="category" value="2">Romantic
                    <br />
                    <input type="radio" class="form-radio" name="category" value="3">Comedy
                    <br />
                    <input type="radio" class="form-radio" name="category" value="4">Adventure
                    <br />
                    <input type="radio" class="form-radio" name="category" value="5">Action
                    <br />
                </div>
            </div>
            <div class="form-signup">
        Title: <input type="text"   name="title" placeholder="Title of Movie"><br>
        Director: <input type="text"  name="director" placeholder="Director of Movie"><br>
        Year: <input type="text" name="year" placeholder="Year of Movie"><br>


        <button type="submit"  name="movielib-submit">Submit</button>
    </div>

        </form>
        </section>
    </div>
</main>




</body>
</html>

