<?php

echo '
    <form method="post" action="' . NEWS_ADMIN_ROOT_URL . '?controller=newsCategory&action=update&updatedId=' . $newsCategoryTableRow->getId() .  '">
        <h1 class="page-header"><input name="title" value="' .  $newsCategoryTableRow->getTitle() . '"></h1>
        <input type="submit">
    </form>';
