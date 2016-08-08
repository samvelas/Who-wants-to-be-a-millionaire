<?php
require_once "blog_db.php";
require_once "components/header.php";
require_once "classes/Category.php";
require_once "classes/CategoryModel.php";

define("ITEMS_PER_PAGE", 3);
$currentPage = 1;

$categoryModel = new CategoryModel();

$categoriesForJS = [];


if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
}

if (isset($_GET['del'])){

    $del = $_GET['del'];
    $categoryModel->deleteCategory($del);
}

if (isset($_POST['title'])) {
    $title = ($_POST['title']);

    $category = new Category();

    $category->setTitle($title);

    if(isset($_POST['isEditing'])) {
        $categoryId = $_POST['isEditing'];
        $category->setId($categoryId);
    }

    if ($title != '') {

        $categoryModel->saveCategory($category);
        $_POST['title'] = '';
    }

}


$categories = $categoryModel->getCategories();
$size = count($categories);

foreach ($categories as $category){
    $tempTitle = $category->getTitle();
    $tempId = $category->getId();
    $tempArray = array(
        "title" => $tempTitle,
        "id" => $tempId
    );
    $categoriesForJS[] = $tempArray;
}


$totalPageCount = ceil($size / ITEMS_PER_PAGE);

$start = ($currentPage - 1) * ITEMS_PER_PAGE + 1;
$limit = ITEMS_PER_PAGE;

if ($start + $limit > $size) {
    $limit = $size - $start;
}

?>

<div class="container-fluid">
    <div id="myModal" class="modal">

        <!-- Modal content -->

        <div class="modal-content" id="content">
            <form method="post" action="categories.php" enctype="multipart/form-data" name="myForm" id="form">
                <h2>Add Post</h2>
                <input id="title" class="form-control" name="title" placeholder="Title"><br>
                <br>
                <button class="btn btn-info btn-md" type="submit">Add</button>
            </form>
        </div>

    </div>
    <div class="col-md-2">
        <h1 class="page-header">Menu</h1>

        <div class="list-group disabled">
            <a class="list-group-item active" href="categories.php">Categories</a>
            <a href="index.php" class="list-group-item">Posts</a>
        </div>
    </div>
    <div class="col-md-offset-1 col-md-8">
        <h1 class="page-header">Categories</h1>
        <button class="btn btn-success btn-lg" id="myBtn" type="submit">Add<span style="margin-left: 15px; color: white" class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
        <table class="table">
            <thead>
            <th>#</th>
            <th>Title</th>
            <th>Delete</th>
            <th>Edit</th>
            </thead>
            <tbody>
            <?php
            for ($i = $start - 1; $i < $start + $limit; $i++) {
                echo "<tr>";
                echo "<td style='font-weight: bolder'>" . ($i + 1) . "</td>";
                echo "<td  onclick='showTags(\"" . $categories[$i]->getTitle() . "\")'>" . $categories[$i]->getTitle() . "</td>";
                echo '<td><a class="btn btn-danger btn-md" onclick="confirmDeleteOf('. $currentPage . ', ' . $categories[$i]->getId() . ')">Delete</a></td>';
                echo '<td><button class="btn btn-warning btn-md" id="edit" onclick="editCategory(' . $i . ')">Edit</button></td>';
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
        <nav>
            <ul class="pagination">
                <?php
                for ($i = 1; $i <= $totalPageCount; $i++) {
                    $style = '';
                    if ($i == $currentPage) {
                        $style = "active";
                    }

                    echo '<li class="' . $style . '"><a href="categories.php?page=' . $i . '">' . $i . '</a></li>';

                }
                ?>
            </ul>
        </nav>
    </div>
</div>
</div>

<?php
require_once "components/footer.php";
?>

<script type="text/javascript">

    function editCategory(ida) {
        var cur = parseInt(ida);
        var users = <?php echo json_encode($categoriesForJS);?>;
        console.log(users);
        var firstField = document.getElementById("title");
        firstField.value = users[cur].title;

        var form = document.getElementById('form');
        modal.style.display = "block";
        var theForm = document.forms['myForm'];
        addHidden(theForm, "isEditing", users[cur].id, 'hidden');
    }

    function confirmDeleteOf(page, id) {
        var action = confirm("Are you sure you want to delete this category?");

        if(action) {
            window.location = "categories.php?page=" + page + "&del=" + id;
        }
    }

    function showTags(tag) {
        window.location = "index.php?tag=" + tag;
    }


</script>
