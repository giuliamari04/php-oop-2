<?php

trait DrowCard
{
    public function drawCard()
    {
       
        $title = $this->title;
        $content = $this->getContent();
        $custom = $this->getCustom();
        $image = $this->getImg();
        $flag = $this->getFlag();
        $genre = $this->getGenre();

        include __DIR__ . "/../Views/card.php";
    }
}
