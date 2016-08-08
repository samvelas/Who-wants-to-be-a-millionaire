<?php

require_once NEWS_ADMIN_ROOT . '/Entity/NewsTableRow.php';
require_once NEWS_ADMIN_ROOT . '../core/classes/Connection.php';

class NewsTable
{
    /**
     * @var string
     */
    private $dbTable;

    /**
     * SudentDB constructor.
     * @param string $dbTable
     */
    public function __construct()
    {
        $this->dbTable = 'blog_posts';
    }

    public function getNews($limit, $offset)
    {
        $statement = Connection::getConnection()->prepare('
            SELECT
              id, date_created, title, content
              FROM ' . $this->dbTable . ' LIMIT ' . $limit . ' OFFSET ' . $offset
        );
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $result = $statement->fetchAll();

        $news = [];
        foreach ($result as $item) {
            $newsItem = new NewsTableRow();
            $newsItem->setId($item['id']);
            $newsItem->setDate($item['date_created']);
            $newsItem->setTitle($item['title']);
            $newsItem->setContent($item['content']);
            $news[] = $newsItem;
        }
        return $news;
    }

    public function getNewsAtId($newsId)
    {
        $statement = Connection::getConnection()->prepare('
            SELECT * FROM ' . $this->dbTable . ' WHERE id=' . $newsId
        );
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $result = $statement->fetch();

        $newsTableRow = new NewsTableRow();

        $newsTableRow->setTitle($result['title']);
        $newsTableRow->setContent($result['content']);
        $newsTableRow->setId($result['id']);

        return $newsTableRow;
    }

    public function getNewsCount()
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

    /**
     * @param $news NewNews
     */
    public function addNews($news)
    {
        $statement = Connection::getConnection()->prepare('
            INSERT INTO ' .
            $this->dbTable .
            ' (`title`, `content`)
            VALUES (:title, :content)'
        );

        $statement->bindParam("title", $news->getTitle(), PDO::PARAM_STR);
        $statement->bindParam("content", $news->getContent(), PDO::PARAM_STR);

        $statement->execute();
    }

    public function deleteNews($id)
    {
        $statement = Connection::getConnection()->prepare('DELETE FROM ' . $this->dbTable . ' WHERE id=' . $id);
        $statement->execute();

    }

    /**
     * @param $updatedNews NewsTableRow
     */
    public function updateNews($updatedNews)
    {
        $statement = Connection::getConnection()->prepare('
            UPDATE ' .
            $this->dbTable .
            ' SET title="' . $updatedNews->getTitle() . '", content = "' . $updatedNews->getContent() . '" WHERE id=' . $updatedNews->getId()
        );

        $statement->execute();
    }
}