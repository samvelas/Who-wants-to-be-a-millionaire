<?php

class HTMLList
{
    const ORDERED_LIST = 'ol';
    const UNORDERED_LIST = 'ul';
    
    /**
     * @var ListItem[]
     */
    private $listItems;
    
    private $type;

    /**
     * HTMLList constructor.
     */
    public function __construct()
    {
        $this->listItems = [];
        $this->type = "ul";
    }
    
    public function addItem(ListItem $item)
    {
        $this->listItems[] = $item;
    }
    
    public function setType($type)
    {
        if ($type == self::ORDERED_LIST || $type == self::UNORDERED_LIST) {
            $this->type = $type;
        }
    }
    
    public function draw()
    {
        echo '<' . $this->type . '>';
        foreach ($this->listItems as $listItem){
            $listItem->draw();
        }
        echo '<' . $this->type . '/>';
    }
}