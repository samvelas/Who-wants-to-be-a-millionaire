<?php

    include "read_files.php";
    session_start();
    $_SESSION['easyUsed'][] = -1;
    $_SESSION['mediumUsed'][] = -1;
    $_SESSION['hardUsed'][] = -1;
    $scale = array(100, 200, 300, 500, 1000, 2000, 4000, 8000, 16000, 32000, 64000, 125000, 250000, 500000, 1000000);
    $scale = array_reverse($scale);
    $currentQuestion = 1;



    if(isset($_GET['lost']) && $currentQuestion != 15){
        $_SESSION['current'] = 1;
        $_SESSION['easyUsed'] = [];
        $_SESSION['mediumUsed'] = [];
        $_SESSION['hardUsed'] = [];
    }



    if(isset($_SESSION['current'])){
        $currentQuestion = $_SESSION['current'];
    }

    $_SESSION['current'] = $currentQuestion + 1;

    if ($currentQuestion >= 1 && $currentQuestion <= 5){
        $currentQuestions = $easyQuestions;
        $currentAnswers = $easyAnswers;
        $currentRight = $rightOfEasy;
        $currentIndex = rand(0, count($currentQuestions) - 1);
        while (in_array($currentIndex, $_SESSION['easyUsed'])) {
            $currentIndex = rand(0, count($currentQuestions) - 1);
        }
        $_SESSION['easyUsed'][] = $currentIndex;

    } else if ($currentQuestion >= 6 && $currentQuestion <= 10){
        $currentQuestions = $mediumQuestions;
        $currentAnswers = $mediumAnswers;
        $currentRight = $rightOfMedium;
        $currentIndex = rand(0, count($currentQuestions) - 1);
        while (in_array($currentIndex, $_SESSION['mediumUsed'])) {
            $currentIndex = rand(0, count($currentQuestions) - 1);
        }
        $_SESSION['mediumUsed'][] = $currentIndex;
    } else if ($currentQuestion >= 11 && $currentQuestion <= 15){
        $currentQuestions = $hardQuestions;
        $currentAnswers = $hardAnswers;
        $currentRight = $rightOfHard;
        $currentIndex = rand(0, count($currentQuestions) - 1);
        while (in_array($currentIndex, $_SESSION['hardUsed'])) {
            $currentIndex = rand(0, count($currentQuestions) - 1);
        }
        $_SESSION['hardUsed'][] = $currentIndex;
    }

    if($currentQuestion == 15){
        session_destroy();
    }

    $wrongAnswer = intval($currentRight[$currentIndex][1]);
    $rightAnswer = intval($currentRight[$currentIndex][1]);

    while ($wrongAnswer == $rightAnswer){
        $wrongAnswer = rand (1, 4);
    }






?>

<html>

    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/main.css">
        <meta charset="UTF-8">
    </head>

    <body>
        <div id="loserModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="assets/logo.png" width="100%">
                        </div>
                        <div class="col-md-9">
                            <h2>Congratulations, you won <?php echo $scale[floor((15 - $currentQuestion) / 5) * 5] ?>$</h2>
                            <button class="btn btn-md btn-warning" onclick="startOver()">Start Over</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9 main-container">
                    <div class="row game-container">
                        <div class="col-md-3 hall-hint">
                            <div class="row percent">
                                <div class="col-md-3">
                                    <h3><span id="a-percent" class="answer-percent">25%</span></h3>
                                </div>
                                <div class="col-md-3">
                                    <h3><span id="b-percent" class="answer-percent">25%</span></h3>
                                </div>
                                <div class="col-md-3">
                                    <h3><span id="c-percent" class="answer-percent">25%</span></h3>
                                </div>
                                <div class="col-md-3">
                                    <h3><span id="d-percent" class="answer-percent">25%</span></h3>
                                </div>
                            </div>
                            <div class="row bar-container">
                                <div class="col-md-3">
                                    <div class="bar">

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="bar">

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="bar">

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="bar">

                                    </div>
                                </div>
                            </div>
                            <div class="row letter">
                                <div class="col-md-3">
                                    <h3><span class="answer-letter">A</span></h3>
                                </div>
                                <div class="col-md-3">
                                    <h3><span class="answer-letter">B</span></h3>
                                </div>
                                <div class="col-md-3">
                                    <h3><span class="answer-letter">C</span></h3>
                                </div>
                                <div class="col-md-3">
                                    <h3><span class="answer-letter">D</span></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-offset-1 col-md-4">
                            <div class="hint">
                                <h2 class="big" id="hint">

                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="row quiz-container">
                        <div class="col-md-12 idk">
                            <div class="row question-container">
                                <h1>
                                    <?php
                                        echo $currentQuestions[$currentIndex];
                                    ?>
                                </h1>
                            </div>
                            <div class="row answer-row-1">
<!--                                <div class="col-md-1 triangle-left"></div>-->
                                <div id="1" onclick="state_checked(this.id)" class="col-md-6 col-sm-6 col-xs-6 ans-left-top">
                                    <h3>
                                        <?php
                                        echo '<span class="glyphicon glyphicon-triangle-right"></span>';
                                        echo '<span class="answer-letter">A:</span>';
                                        echo $currentAnswers[$currentIndex][0];
                                        ?>
                                    </h3>
                                </div>
<!--                                <div class="col-md-1 triangle-right"></div>-->
                                <div id="3" onclick="state_checked(this.id)" class="col-md-6 col-sm-6 col-xs-6 ans-left-bottom">
                                    <h3>
                                        <?php
                                        echo '<span class="glyphicon glyphicon-triangle-right"></span>';
                                        echo '<span class="answer-letter">B:</span>';
                                        echo $currentAnswers[$currentIndex][2];
                                        ?>
                                    </h3>
                                </div>
                            </div>
                            <div class="row answer-row-2">
                                <div id="2" onclick="state_checked(this.id)" class="col-md-6 col-sm-6 col-xs-6 ans-right-top">
                                    <h3>
                                        <?php
                                        echo '<span class="glyphicon glyphicon-triangle-right"></span>';
                                        echo '<span class="answer-letter">C:</span>';
                                        echo $currentAnswers[$currentIndex][1];
                                        ?>
                                    </h3>
                                </div>
                                <div id="4" onclick="state_checked(this.id)" class="col-md-6 col-sm-6 col-xs-6 ans-right-bottom">
                                    <h3>
                                        <?php
                                        echo '<span class="glyphicon glyphicon-triangle-right"></span>';
                                        echo '<span class="answer-letter">D:</span>';
                                        echo $currentAnswers[$currentIndex][3];
                                        ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 nav-container">
                    <div class="row help-container">
                        <div class="col-md-4">
                            <img src="assets/call.png" id="call-help" class="help" width="100%" onclick="call() ">
                        </div>
                        <div class="col-md-4">
                            <img src="assets/hall.png" id="hall-help" class="help" width="100%" onclick="hall()">
                        </div>
                        <div class="col-md-4">
                            <img src="assets/half.png" id="half-help" class="help" width="100%" onclick="half()">
                        </div>
                    </div>
                    <div class="row scale-container">
                        <ul class="nav nav-pills nav-stacked">
                            <?php
                                $size = count($scale);
                                foreach ($scale as $key => $item){
                                    echo '<li role="presentation" id="' . "scale" . (15 - $key) . '"><a id="' . "ascale" . (15 - $key) . '" class="text">';
                                    echo '<span>' . $size . '</span>';
                                    echo  '<span class="glyphicon glyphicon-triangle-right sc" aria-hidden="true"></span>';
                                    echo $item;
                                    echo '</a></li>';
                                    $size --;
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <script src="assets/script.js"></script>
        <script type="text/javascript">
            var opened = false;
            var cur = <?php echo json_encode($currentQuestion) ?>;
            var element = document.getElementById("scale" + cur);
            element.className += "active";
            for(var i = 1; i <= 15; i++){
                if(i == 5 || i == 10 || i == 15) {
                    var content = document.getElementById("ascale" + i);
                    content.className += " static";
                }
            }

            function state_checked(id) {
                var checked = document.getElementById(id);
                checked.style.backgroundColor = "#FF7701";
                var trueAnswer = <?php echo json_encode($currentRight[$currentIndex][1]) ?>;
//                alert(trueAnswer.toString());
//                alert(id.toString());
                if(id.toString() == trueAnswer.toString()) {
                    setTimeout(function () {
                        state_true(id);
                    }, 1500);
                } else {
                    setTimeout(function () {
                        state_false(id);
                    }, 1500);
                }
            }

            function state_true(id) {
                var checked = document.getElementById(id);
                checked.style.backgroundColor = "#37C32F";
                setTimeout(function(){
                    window.location = "index.php";
                }, 1000);
            }

            function state_false(id) {
                var trueAnswer = <?php echo json_encode($currentRight[$currentIndex][1]) ?>;
                var trueDiv = document.getElementById(trueAnswer);
                trueDiv.style.backgroundColor = "#37C32F";
                var modal = document.getElementById('loserModal');
                setTimeout(function(){
                    modal.style.display = "block";
                }, 1000);

            }

            function startOver() {
                window.location = "index.php?lost=true";
            }

            function half() {

                document.getElementById("half-help").setAttribute("style","-webkit-filter: blur(" + 5 + "px)");

                var Answer = <?php echo json_encode($currentRight[$currentIndex][1]) ?>;

                var trueAnswer = parseInt(Answer);
                var first = trueAnswer, second = trueAnswer;

                while(first == trueAnswer){
                    first = Math.floor((Math.random() * 4) + 1);
                }

                while(second == trueAnswer || second == first) {
                    second = Math.floor((Math.random() * 4) + 1);
                }

                document.getElementById(first + "").innerHTML = "";
                document.getElementById(second + "").innerHTML = "";

                document.getElementById("half-help").onclick = function() {
                    return false;
                };
                document.getElementById(first + "").onclick = function() {
                    return false;
                };
                document.getElementById(second + "").onclick = function() {
                    return false;
                };
            }


            function call() {
                opened = true;
                document.getElementById("call-help").setAttribute("style","-webkit-filter: blur(" + 5 + "px)");
                document.getElementsByClassName("hint")[0].setAttribute("style","opacity:0.9; -moz-opacity:0.9;");
                var current = <?php echo json_encode($currentQuestion) ?>;
                var Answer = <?php echo json_encode($currentAnswers[$currentIndex][intval($currentRight[$currentIndex][1]) - 1]); ?>;
                var wrong = <?php echo json_encode($currentAnswers[$currentIndex][$wrongAnswer - 1])  ?>

                var rand;
                var result = "";

                if (current >= 1 && current <= 5){
                    result += 'I\'m sure answer is <span class="ans">' + Answer + '</span>';
                } else if (current >= 6 && current <= 10) {
                    rand = Math.floor(Math.random() * 2);
                    alert(rand);
                    if(rand == 0 || rand == 1){
                        result += 'The answer should be <span class="ans">' + Answer + '</span>';
                    } else {
                        result += 'The answer should be <span class="ans">' + wrong + '</span>';
                    }
                } else {
                    rand = Math.floor(Math.random() * 2);
                    if(rand == 2){
                        result += 'The answer should be <span class="ans">' + Answer + '</span>';
                    } else {
                        result += 'The answer should be <span class="ans">' + wrong + '</span>';
                    }
                }

                document.getElementById("hint").innerHTML = result;

                setTimeout( function(){
                    document.getElementsByClassName("hint")[0].setAttribute("style", "opacity:0; -moz-opacity:0;");
                }, 5000);

                document.getElementById("call-help").onclick = function() {
                    return false;
                };

            }

            function hall() {
                document.getElementById("hall-help").setAttribute("style","-webkit-filter: blur(" + 5 + "px)");
                document.getElementsByClassName("hint")[0].setAttribute("style","opacity:0.9; -moz-opacity:0.9;");
            }



        </script>
    </body>
</html>
