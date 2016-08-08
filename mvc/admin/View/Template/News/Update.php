<?php

echo '
    <form method="post" action="' . NEWS_ADMIN_ROOT_URL . '?controller=news&action=update&updatedId=' . $newsTableRow->getId() .  '">
        <h1 class="page-header"><input name="title" value="' .  $newsTableRow->getTitle() . '"></h1>
        <h2><input name="content" value="' .  $newsTableRow->getContent() . '"></h2>
        <input type="submit">
    </form>';
