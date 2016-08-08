<h1 class="header page-header">News Categories</h1>
<a  class="header add-button btn btn-lg btn-success" href="<?= NEWS_ADMIN_ROOT_URL . '?controller=newsCategory&action=add' ?>">Add</a>
<table class="table">

    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Action</th>
    </tr>

    <?php
    foreach ($newsCategories as $key => $value){
        echo
            '<tr>
                <td>' . ($key + 1) . '</td>
                <td>' . $value->getTitle() . '</td>
                <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a href="' . NEWS_ADMIN_ROOT_URL . '?controller=newsCategory&action=delete&deleteId=' . $value->getId() . '">Delete</a></li>
                        <li><a href="' . NEWS_ADMIN_ROOT_URL . '?controller=newsCategory&action=update&updateId=' . $value->getId() . '">Edit</a></li>
                      </ul>
                    </div>
                </td>
            </tr>';
    }
    ?>
</table>

<?php
$pagination->draw();
?>
