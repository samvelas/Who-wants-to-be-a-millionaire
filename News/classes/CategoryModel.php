<?php

require_once "PDOConnection.php";

class CategoryModel
{
    private $dbTable;

    private $dbConnection;

    /**
     * BlogModel constructor.
     */
    public function __construct()
    {
        $this->dbTable = "blog_post_categories";
        $this->dbConnection = new PDOConnection();
    }

    public function getCategories()
    {
        $statement = $this->dbConnection->getConnection()->prepare("SELECT * FROM " . $this->dbTable);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $result = $statement->fetchAll();

        $categories = [];
        foreach ($result as $item) {
            $category = new Category();

            $category->setId($item['id']);
            $category->setTitle($item['title']);

            $categories[] = $category;
        }

        return $categories;
    }

    public function deleteCategory($categoryId)
    {

        $statement = $this->dbConnection->getConnection()->prepare("DELETE FROM " . $this->dbTable . " WHERE id=" . $categoryId);
        $statement->execute();

    }

    public function saveCategory(Category $category)
    {
        $title = $category->getTitle();

        if($category->getId()){
            $id = $category->getId();
            $action = 'UPDATE';
        } else {
            $action = "INSERT";
        }

        if ($action == "INSERT") {
            $statement = $this->dbConnection->getConnection()->prepare("INSERT INTO " . $this->dbTable . " (title) VALUES ('" . $title . "')");
        } else if ($action == "UPDATE") {
            $statement = $this->dbConnection->getConnection()->prepare("UPDATE " . $this->dbTable . " SET title = '{$title}' WHERE id=". $id);
        }

        $statement->execute();

    }
}