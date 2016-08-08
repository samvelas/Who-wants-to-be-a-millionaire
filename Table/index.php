<?php

include "TableRow.php";

/**
 * Created by PhpStorm.
 * User: samvel
 * Date: 7/22/16
 * Time: 12:43 PM
 */

$simpleRow = array(1, 2, 3);

$table = new TableRow($simpleRow);

$table->drawRow();