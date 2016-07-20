<?php

$easyQuestions = [];
$mediumQuestions = [];
$hardQuestions = [];

$easyAnswers = [];
$mediumAnswers = [];
$hardAnswers = [];

$easy = fopen("files/questions_easy.txt","r");
$medium = fopen("files/questions_medium.txt","r");
$hard = fopen("files/questions_hard.txt","r");

while (!feof($easy)){
    $line = fgets($easy);
    $row = explode("|", $line);
    $easyQuestions[] = $row[0];
    $easyAnswers[] = [$row[1], $row[2], $row[3], $row[4]];
    $rightOfEasy[] = $row[5];
}
while (!feof($medium)){
    $line = fgets($medium);
    $row = explode("|", $line);
    $mediumQuestions[] = $row[0];
    $mediumAnswers[] = [$row[1], $row[2], $row[3], $row[4]];
    $rightOfMedium[] = $row[5];
}
while (!feof($hard)){
    $line = fgets($hard);
    $row = explode("|", $line);
    $hardQuestions[] = $row[0];
    $hardAnswers[] = [$row[1], $row[2], $row[3], $row[4]];
    $rightOfHard[] = $row[5];
}

fclose($easy);
fclose($medium);
fclose($hard);

?>