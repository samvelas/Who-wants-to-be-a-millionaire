<?php

/**
 * Created by PhpStorm.
 * User: samvel
 * Date: 7/22/16
 * Time: 12:42 PM
 */

class TableRow
{
    private $cells = [];

    public function __construct($cells)
    {
        foreach ($cells as $cell){
            $this->cells[] = $cell;
        }
    }

    public function drawRow(){
        echo '<tr>';
        foreach ($this->cells as $cell){
            $temp = new TableCell($cell);
            $temp->drawCell();
        }
        echo '</tr>';
    }
}