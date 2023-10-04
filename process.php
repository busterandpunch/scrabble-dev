<?php
    use Src\Boot;
    use Src\Engine\Dictionary\Dictionary;
    use Src\Engine\Scrabble;

    require_once 'Src/Boot.php';
    $boot = new Boot();
    $dictionary = new Dictionary($boot);
    $scrabble = new Scrabble($dictionary);

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        if(isset($_POST['submit'])){
            $word = strtolower($_POST['word']);
            $rack = $_POST['rack'];
            if(!ctype_alpha(strtolower($word))){
                echo "invalid characters";
            }else{
                if(array_key_exists($word, $scrabble->matchInDictionary($rack))){
                    echo "Your score is ".$scrabble->matchInDictionary($rack)[$word];
                }else{
                    echo "Word does not exist in dictionary";
                }
            }                          
        }
    }