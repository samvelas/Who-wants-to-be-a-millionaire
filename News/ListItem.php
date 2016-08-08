<?php

class ListItem
{
    private $content;

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }
    
    public function draw()
    {
        echo "<li>" . $this->content . "</li>";
    }
}