<?php
if (isset($_GET['group'])) {
    $group = $_GET['group'];
    $cur = fopen("files/current.txt", "w");
    fwrite($cur, "files/questions_" . $group . ".txt");
    fclose($cur);
}

$file = file_get_contents("files/current.txt");
if(isset($_GET['question']) && isset($_GET['answer_1']) && isset($_GET['answer_2']) && isset($_GET['answer_3']) && isset($_GET['answer_4'])  && isset($_GET['right'])){
    $question = $_GET['question'];
    $answer1 = $_GET['answer_1'];
    $answer2 = $_GET['answer_2'];
    $answer3 = $_GET['answer_3'];
    $answer4 = $_GET['answer_4'];
    $rightAnswer = $_GET['right'];
    $line = "\n" . $question . " | " . $answer1 . " | " . $answer2 . " | " . $answer3 . " | " . $answer4 . " | " . $rightAnswer;
    $f = fopen($file, "a")  or die("Can't open file");
    fwrite($f, $line);
    fclose($f);
}
?>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="../assets/main.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <form>
                    <textarea class="form-control" id="question" placeholder="Enter question" name="question"></textarea>
                    <input class="answer form-control" id="answer1" placeholder="Answer 1" name="answer_1">
                    <input class="answer form-control" id="answer2" placeholder="Answer 2" name="answer_2">
                    <input class="answer form-control" id="answer3" placeholder="Answer 3" name="answer_3">
                    <input class="answer form-control" id="answer4" placeholder="Answer 4" name="answer_4">
                    <h2>Choose the right answer</h2>
                    <input class="radio" type="radio" name="right" value="1">
                    <label for="1">Answer 1</label>
                    <input class="radio" type="radio" name="right" value="2">
                    <label for="2">Answer 2</label>
                    <input class="radio" type="radio" name="right" value="3">
                    <label for="3">Answer 3</label>
                    <input class="radio" type="radio" name="right" value="4">
                    <label for="4">Answer 4</label>
                    <button id="add" class="btn btn-lg btn-warning" type="submit">Add</button>
                </form>
                <a class="btn btn-lg btn-info" href="admin.php">Back</a>
            </div>

        </div>
    </body>
</html>

