<?php

require_once NEWS_ADMIN_ROOT . '/Entity/NewsCategoryTableRow.php';
require_once NEWS_ADMIN_ROOT . '../core/classes/Connection.php';

class NewsCategoryTable
{
    /**
     * @var string
     */
    private $dbTable;

    public function __construct()
    {
        $this->dbTable = "blog_post_categories";
    }

    public function getNewsCategories($limit, $offset)
    {
        $statement = Connection::getConnection()->prepare('
            SELECT
              id, title
              FROM ' . $this->dbTable . ' LIMIT ' . $limit . ' OFFSET ' . $offset
        );

        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $result = $statement->fetchAll();

        $newsCategories = [];
        foreach ($result as $item){
            $newsCategory = new NewsCategoryTableRow();
            $newsCategory->setId($item['id']);
            $newsCategory->setTitle($item['title']);
            $newsCategories[] = $newsCategory;
        }
        return $newsCategories;

    }

    public function getCategoryAtId($categoryId)
    {
        $statement = Connection::getConnection()->prepare('
            SELECT * FROM ' . $this->dbTable . ' WHERE id=' . $categoryId
        );
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $result = $statement->fetch();

        $newsTableRow = new NewsCategoryTableRow();

        $newsTableRow->setTitle($result['title']);
        $newsTableRow->setId($result['id']);

        return $newsTableRow;
    }

    public function getCategoriesCount()
    {
        $statement = Connection::getConnection()->prepare('
            SELECT
              COUNT(*) as count
              FROM ' . $this->dbTable
        );
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $result = $statement->fetch();
        $count = $result['count'];

        return $count;
    }

    public function addCategory($category)
    {
        $statement = Connection::getConnection()->prepare('
            INSERT INTO '.
            $this->dbTable.
            ' (`title`)
            VALUES (:title)'
        );

        $statement->bindParam("title", $category->getTitle(), PDO::PARAM_STR);

        $statement->execute();
    }

    public function deleteCategory($id)
    {
        $statement = Connection::getConnection()->prepare('DELETE FROM ' . $this->dbTable . ' WHERE id=' . $id);
        $statement->execute();

    }

    public function updateCategory($updatedCategory)
    {
        $statement = Connection::getConnection()->prepare('
            UPDATE ' .
            $this->dbTable .
            ' SET title="' . $updatedCategory->getTitle() . '" WHERE id=' . $updatedCategory->getId()
        );

        $statement->execute();
    }
}