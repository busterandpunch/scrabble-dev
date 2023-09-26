<!DOCTYPE html>
<html>
<head>
    <title>Scrabble</title>
</head>
<body>
    <h1>Scrabble</h1>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="rack">Enter your Scrabble tiles:</label>
        <input type="text" name="rack" id="rack" required>
        <br>
        <input type="submit" value="Submit">
    </form>

    <?php
    use Src\Boot;
    use Src\Engine\Dictionary\Dictionary;
    use Src\Engine\Scrabble;

    require_once 'Src/Boot.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $boot = new Boot();
        $dictionary = new Dictionary($boot);
        $scrabble = new Scrabble($dictionary);

        // Get the rack input from the form
        $rack = $_POST["rack"];

        // Run the Scrabble match and display the results
        $results = $scrabble->matchInDictionary($rack);
        
        // Display the results
        echo "<h2>Results:</h2>";
        if (empty($results)) {
            echo "No valid words found for the given rack.";
        } else {
          $count=0;
            foreach ($results as $word => $score) {
              $count++;
                echo "<p>$count - Word: $word, Score: $score</p>";
            }
        }
    }
    ?>
</body>
</html>
