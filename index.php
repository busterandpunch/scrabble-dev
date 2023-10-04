<?php

    use Src\Boot;
    use Src\Engine\Dictionary\Dictionary;
    use Src\Engine\Scrabble;

    require_once 'Src/Boot.php';
    $boot = new Boot();
    $dictionary = new Dictionary($boot);
    $scrabble = new Scrabble($dictionary);


    //Alphabet Tiles
    $tiles = [
        'A', 'B', 'C', 'D', 'E',
        'F', 'G', 'H', 'I', 'J',
        'K', 'L', 'M', 'N', 'O',
        'P', 'Q', 'R', 'S', 'T',
        'U', 'V', 'W', 'X', 'Y', 'Z',
    ];

    //Shuffled Alphabet Tiles
    shuffle($tiles);
    $shuffledTiles = $tiles;

    //set initial rack size
    $initialRackSize = 7;

    //generate rack
    $rack = array_splice($shuffledTiles, 0, $initialRackSize);

    /**
     * Engine = $scrabble
     *
     * to run a match use the method matchInDictionary
     * this will return an array of words and scores
     */
    $t = implode(",", $rack);
    $s = str_replace(",", "", $t);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scrabble</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main-wrapper">
        <div class="container">
            <div class="title">
                <h3>Scrabble Game</h3>
                <p>Your Rack, Click to select a letter</p>
            </div>
            <div class="rack">
                <?php
                    foreach($rack as $r){ ?>
                        <div class="tiles" onclick="addToBoard(this)"><?php echo $r; ?></div>
                    <?php }
                ?>
            </div>
            <form method="POST" id="submitForm">
                <input type="text" id="word" name="word" required/>
                <input type="hidden" id="rack" value="<?php echo $s; ?>" />
                <button type="submit" name="submit">Submit</button>
            </form>

            <div class="msg">
                <p id="response"></p>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="./script.js"></script>
    <script>
        $(document).ready(function(){
            $("#submitForm").submit(function(e){
                e.preventDefault()
                let word = $("#word").val();
                let rack = $("#rack").val();

                if(word === ""){
                    $("#response").text("Enter a word")
                }else{
                    $.ajax({
                        method: "POST",
                        url: "./process.php",
                        data:{
                            'submit': 1,
                            'word': word,
                            'rack': rack
                        },
                        success: function(data){
                            $("#response").text(data)
                        }
                    })
                }
            })
        })
    </script>
</body>
</html>
