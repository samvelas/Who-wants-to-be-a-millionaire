<?php

require_once NEWS_ADMIN_ROOT . '../core/Model/NewsTable.php';
require_once NEWS_ADMIN_ROOT . '../core/classes/View.php';
require_once NEWS_ADMIN_ROOT . '../core/classes/Pagination.php';
require_once NEWS_ADMIN_ROOT . 'Entity/NewNews.php';

class NewsController
{
    public function listAction()
    {
        $newsTable = new NewsTable();
        $newsCount = $newsTable->getNewsCount();
        $pagination = new Pagination($newsCount, 'controller=news&action=list');

        $news = $newsTable->getNews(Pagination::ITEMS_PER_PAGE, $pagination->getOffset());

        $view = new View('News/List');
        $view->assign('news', $news);
        $view->assign('pagination', $pagination);

        return $view;
    }

    public function addAction()
    {
        if (count($_POST)) {
            $title = $_POST['title'];
            $content = $_POST['content'];

            $newNews = new NewNews();
            $newNews->setTitle($title);
            $newNews->setContent($content);

            $newsTable = new NewsTable();

            $newsTable->addNews($newNews);
        }

        $view = new View('News/Add');

        return $view;
    }

    public function updateAction()
    {
        if (isset($_GET['updateId'])) {

            $newsId = $_GET['updateId'];
            $newsTable = new NewsTable();

            $newsTableRow = $newsTable->getNewsAtId($newsId);

            $view = new View('News/Update');
            $view->assign('newsTableRow', $newsTableRow);

            return $view;
        }

        if (isset($_GET['updatedId'])) {
            if (count($_POST)) {

                $title = $_POST['title'];
                $content = $_POST['content'];

                $updatedTableRow = new NewsTableRow();

                $updatedTableRow->setTitle($title);
                $updatedTableRow->setContent($content);
                $updatedTableRow->setId($_GET['updatedId']);

                $newsTable = new NewsTable();
                $newsTable->updateNews($updatedTableRow);

                $newsCount = $newsTable->getNewsCount();
                $pagination = new Pagination($newsCount, 'controller=news&action=list');

                $news = $newsTable->getNews(Pagination::ITEMS_PER_PAGE, $pagination->getOffset());

                $view = new View('News/List');
                $view->assign('news', $news);
                $view->assign('pagination', $pagination);

                return $view;

            }
        }
    }

    public function deleteAction()
    {
        if (isset($_GET['deleteId'])) {

            $newsId = $_GET['deleteId'];

            $newsTable = new NewsTable();

            $newsTable->deleteNews($newsId);

            $newsCount = $newsTable->getNewsCount();
            $pagination = new Pagination($newsCount, 'controller=news&action=list');

            $news = $newsTable->getNews(Pagination::ITEMS_PER_PAGE, $pagination->getOffset());

            $view = new View('News/List');
            $view->assign('news', $news);
            $view->assign('pagination', $pagination);

            return $view;
        }
    }
}