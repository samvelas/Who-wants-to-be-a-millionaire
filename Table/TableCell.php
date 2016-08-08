<?php

/**
 * Created by PhpStorm.
 * User: samvel
 * Date: 7/22/16
 * Time: 12:42 PM
 */
class TableCell
{
    private $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function drawCell(){
        echo '<td>' . $this->content . '</td>';
    }
}