<?php

/**
 * Created by PhpStorm.
 * User: samvel
 * Date: 8/8/16
 * Time: 4:05 PM
 */
class NewCategory
{
    protected $title;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }


}