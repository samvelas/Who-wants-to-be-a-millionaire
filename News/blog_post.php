<head>
    <meta charset="UTF-8">
    <title>ACA</title>
    <link rel="stylesheet" href="assets/website-main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymo">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
</head>


<?php

require_once "blog_db.php";
require_once "classes/BlogModel.php";

$blogModel = new BlogModel();

$currentPost = $blogModel->getPostAtId($_GET['id']);

$currentTags = $blogModel->getTagsOfPost($_GET['id']);


?>

<script type="text/javascript">
    document.body.style.backgroundImage = "url('')";
</script>

<div class="container">
    <h1 style="display: block !important; width: 100%; color: black !important;" id="title" class="page-header"><?php echo $currentPost['title'] ?></h1>
    <div class="row">
        <div class="tags col-md-8">
            <?php
                foreach ($currentTags as $currentTag) {
                        echo '<span class="tag"><a href="index.php?tag=' . $currentTag . '">#' . $currentTag . '</a></span>';
                }
            ?>
        </div>
        <div style="background-color: transparent" class="col-md-offset-1 col-md-3">
            Created at <?php echo $currentPost['date_created']; ?>
        </div>
    </div>
    <div class="row">
        <h3 class="content_container">
            <?php echo $currentPost['content']; ?>
        </h3>
    </div>
</div>
