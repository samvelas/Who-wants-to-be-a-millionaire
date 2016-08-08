<?php
require_once "PDOConnection.php";
require_once "BlogPost.php";
require_once "Category.php";

class BlogModel
{
    private $dbTable;

    private $dbConnection;

    /**
     * BlogModel constructor.
     */
    public function __construct()
    {
        $this->dbTable = "blog_posts";
        $this->dbConnection = new PDOConnection();
    }

    public function getPosts()
    {
        $res = [];
        $posts = [];

        $statement = $this->dbConnection->getConnection()->prepare("SELECT * FROM " . $this->dbTable);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $result = $statement->fetchAll();

        foreach ($result as $item) {
            $post = new BlogPost();

            $statement = $this->dbConnection->getConnection()->prepare("SELECT category_id FROM rel_blog_post_category WHERE blog_post_id=" . $item['id']);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $tags = $statement->fetchAll();

            foreach ($tags as $tag){
                $res[] = $tag['category_id'];
            }

            $post->setCategories($res);
            $post->setId($item['id']);
            $post->setDateCreated($item['date_created']);
            $post->setTitle($item['title']);
            $post->setContent($item['content']);
            $post->setAuthorId($item['author_id']);
            $post->setImage($item['image']);

            $posts[] = $post;
        }

        return $posts;
    }

    public function getPostAtId($postId)
    {
        $statement = $this->dbConnection->getConnection()->prepare("SELECT * FROM " . $this->dbTable . " WHERE id=" . $postId);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $result = $statement->fetchAll();

        foreach ($result as $item){
            $answer = $item;
        }

        return $answer;
    }

    public function deletePost($postId)
    {

        $statement = $this->dbConnection->getConnection()->prepare("SELECT * FROM " . $this->dbTable . " WHERE id=" . $postId);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $result = $statement->fetchAll();

        $statement = $this->dbConnection->getConnection()->prepare("DELETE FROM rel_blog_post_category WHERE blog_post_id=" . $postId);
        $statement->execute();

        $statement = $this->dbConnection->getConnection()->prepare("DELETE FROM " . $this->dbTable . " WHERE id=" . $postId);
        $statement->execute();

        foreach ($result as $item){
            $imgDir = $item['image'];
        }

        unlink($imgDir);
    }

    public function getTagsOfPost($postId)
    {
        $tags = [];

        $statement = $this->dbConnection->getConnection()->prepare("SELECT blog_post_categories.title FROM blog_posts
                                                                    JOIN rel_blog_post_category ON blog_posts.id = rel_blog_post_category.blog_post_id
                                                                    JOIN blog_post_categories ON rel_blog_post_category.category_id = blog_post_categories.id
                                                                    WHERE blog_posts.id=" . $postId);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $result = $statement->fetchAll();

        foreach ($result as $item){
            $tags[] = $item['title'];
        }

        return $tags;
    }

    public function searchPostsAtTag($tag)
    {
        $posts = [];

        $statement = $this->dbConnection->getConnection()->prepare("SELECT blog_posts.* FROM blog_post_categories
                                                                    JOIN rel_blog_post_category ON blog_post_categories.id = rel_blog_post_category.category_id
                                                                    JOIN blog_posts ON blog_posts.id = rel_blog_post_category.blog_post_id 
                                                                    WHERE blog_post_categories.title='{$tag}' ");

        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $result = $statement->fetchAll();

        foreach ($result as $item) {
            $post = new BlogPost();

            $post->setId($item['id']);
            $post->setDateCreated($item['date_created']);
            $post->setTitle($item['title']);
            $post->setContent($item['content']);
            $post->setAuthorId($item['author_id']);
            $post->setImage($item['image']);

            $posts[] = $post;
        }

        return $posts;
    }

    public function saveBlogPost(BlogPost $blogPost)
    {
        $title = $blogPost->getTitle();
        $content = $blogPost->getContent();
        $image = $blogPost->getImage();
        $categories = $blogPost->getCategories();

        if($blogPost->getId()){
            $id = $blogPost->getId();
            $action = 'UPDATE';
        } else {
            $action = "INSERT";
        }

        if ($action == "INSERT") {
            $statement = $this->dbConnection->getConnection()->prepare("INSERT INTO " . $this->dbTable . " (title, content, image) VALUES ('" . $title . "', '" . $content . "', '" . $image . "')");
        } else if ($action == "UPDATE") {
            $statement = $this->dbConnection->getConnection()->prepare("UPDATE blog_posts SET title = '{$title}', content = '{$content}' WHERE id=". $id);
        }

        $statement->execute();

    }


}