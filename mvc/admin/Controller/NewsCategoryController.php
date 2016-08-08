<?php

require_once NEWS_ADMIN_ROOT . '../core/Model/NewsCategoryTable.php';
require_once NEWS_ADMIN_ROOT . '../core/classes/View.php';
require_once NEWS_ADMIN_ROOT . 'Entity/NewCategory.php';
require_once NEWS_ADMIN_ROOT . '../core/classes/Pagination.php';

class NewsCategoryController
{
    public function listAction()
    {
        $newsCategoryTable = new NewsCategoryTable();
        $newsCategoriesCount = $newsCategoryTable->getCategoriesCount();
        $pagination = new Pagination($newsCategoriesCount, 'controller=newsCategory&action=list');

        $newsCategories = $newsCategoryTable->getNewsCategories(Pagination::ITEMS_PER_PAGE, $pagination->getOffset());

        $view = new View('NewsCategory/List');
        $view->assign('newsCategories', $newsCategories);
        $view->assign('pagination', $pagination);

        return $view;
    }

    public function addAction()
    {
        if (count($_POST)) {
            $title = $_POST['title'];

            $newCategory = new NewCategory();
            $newCategory->setTitle($title);

            $newsTable = new NewsCategoryTable();

            $newsTable->addCategory($newCategory);
        }

        $view = new View('NewsCategory/Add');

        return $view;
    }

    public function updateAction()
    {
        if (isset($_GET['updateId'])) {

            $categoryId = $_GET['updateId'];
            $newsCategoryTable = new NewsCategoryTable();

            $newsCategoryTableRow = $newsCategoryTable->getCategoryAtId($categoryId);

            $view = new View('NewsCategory/Update');
            $view->assign('newsCategoryTableRow', $newsCategoryTableRow);

            return $view;
        }

        if (isset($_GET['updatedId'])) {
            if (count($_POST)) {

                $title = $_POST['title'];

                $updatedTableRow = new NewsCategoryTableRow();

                $updatedTableRow->setTitle($title);
                $updatedTableRow->setId($_GET['updatedId']);

                $newsCategoryTable = new NewsCategoryTable();
                $newsCategoryTable->updateCategory($updatedTableRow);

                $newsCategoriesCount = $newsCategoryTable->getCategoriesCount();
                $pagination = new Pagination($newsCategoriesCount, 'controller=newsCategory&action=list');

                $newsCategories = $newsCategoryTable->getNewsCategories(Pagination::ITEMS_PER_PAGE, $pagination->getOffset());

                $view = new View('NewsCategory/List');
                $view->assign('newsCategories', $newsCategories);
                $view->assign('pagination', $pagination);

                return $view;

            }
        }
    }

    public function deleteAction()
    {
        if (isset($_GET['deleteId'])) {

            $categoryId = $_GET['deleteId'];

            $newsCategoryTable = new NewsCategoryTable();

            $newsCategoryTable->deleteCategory($categoryId);

            $newsCategoriesCount = $newsCategoryTable->getCategoriesCount();
            $pagination = new Pagination($newsCategoriesCount, 'controller=newsCategory&action=list');

            $newsCategories = $newsCategoryTable->getNewsCategories(Pagination::ITEMS_PER_PAGE, $pagination->getOffset());

            $view = new View('NewsCategory/List');
            $view->assign('newsCategories', $newsCategories);
            $view->assign('pagination', $pagination);

            return $view;
        }
    }
}