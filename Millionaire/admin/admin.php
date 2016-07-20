<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="../assets/main.css">
    </head>

    <body>

    <?php
        include "read_files.php";
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <h2>Easy questions</h2>
                <?php
                    echo '<div class="list-group">';
                        foreach ($easyQuestions as $question => $key){
                            echo '<div class="list-group-item">';
                                echo '<div class="dropdown">
                                          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">' . $key . '
                                            <span class="caret"></span>
                                          </button>
                                          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">';
                                                foreach ($easyAnswers[$question] as $answer => $num){
                                                    echo '<li>';
                                                    echo ($answer + 1) . ") " . $num;
                                                    echo '</li>';
                                                }
                                        echo '<li class="dropdown-header">Right Answer</li>';
                                        echo '<li>' . $rightOfEasy[$question] . "->" . $easyAnswers[$question][$rightOfEasy[$question] - 1];
                                     echo '</ul>
                                </div>';
                            echo '</div>';
                        }
                    echo '</div>';
                ?>
                <div class="button-container">
                    <a class="btn btn-lg btn-warning" href="admin_add_question.php?group=easy">Add easy question</a>
                </div>
            </div>
            <div class="col-md-4">
                <h2>Medium questions</h2>
                <?php
                echo '<div class="list-group">';
                foreach ($mediumQuestions as $question => $key){
                    echo '<div class="list-group-item">';
                    echo '<div class="dropdown">
                                          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">' . $key . '
                                            <span class="caret"></span>
                                          </button>
                                          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">';
                    foreach ($mediumAnswers[$question] as $answer => $num){
                        echo '<li>';
                        echo ($answer + 1) . ") " . $num;
                        echo '</li>';
                    }
                    echo '<li class="dropdown-header">Right Answer</li>';
                    echo '<li>' . $rightOfMedium[$question] . "->" . $mediumAnswers[$question][$rightOfMedium[$question] - 1];
                    echo '</ul>
                                </div>';
                    echo '</div>';
                }
                echo '</div>';
                ?>
                <div class="button-container">
                    <a class="btn btn-lg btn-warning" href="admin_add_question.php?group=medium">Add medium question</a>
                </div>
            </div>
            <div class="col-md-4">
                <h2>Hard questions</h2>
                <?php
                echo '<div class="list-group">';
                foreach ($hardQuestions as $question => $key){
                    echo '<div class="list-group-item">';
                    echo '<div class="dropdown">
                                          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">' . $key . '
                                            <span class="caret"></span>
                                          </button>
                                          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">';
                    foreach ($hardAnswers[$question] as $answer => $num){
                        echo '<li>';
                        echo ($answer + 1) . ") " . $num;
                        echo '</li>';
                    }
                    echo '<li class="dropdown-header">Right Answer</li>';
                    echo '<li>' . $rightOfHard[$question] . "->" . $hardAnswers[$question][$rightOfHard[$question] - 1];
                    echo '</ul>
                                </div>';
                    echo '</div>';
                }
                echo '</div>';
                ?>
                <div class="button-container">
                    <a class="btn btn-lg btn-warning" href="admin_add_question.php?group=hard">Add hard question</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    </body>
</html>