<?php

/**
 * Created by PhpStorm.
 * User: samvel
 * Date: 7/22/16
 * Time: 12:43 PM
 */
class Table
{
    private $rows = [];

    public function __construct($rows)
    {
        foreach ($rows as $row){
            $this->rows [] = $row;
        }
    }
}