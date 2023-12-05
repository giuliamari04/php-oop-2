<?php

class Game
{
    private int $appid;
    private  string $name;
    private string $playtime_forever;
    private string $img_icon_url;
    private string $img_logo_url;


    public function __construct(int $appid, string $name, string $playtime_forever, string $img_icon_url, string $img_logo_url)
    {
        $this->appid = $appid;
        $this->name = $name;
        $this->playtime_forever = $playtime_forever;
        $this->img_icon_url = $img_icon_url;
        $this->img_logo_url = $img_logo_url;
    }

    
    public function getlogo(){
        if($this->appid == 240 || $this->appid == 280){
           $template=" ";
        }else{
        $template="<img src= \"http://media.steampowered.com/steamcommunity/public/images/apps/";
        $template.= $this->appid;
        $template.= "/";
        $template.= $this->img_icon_url;
        $template.=".jpg\" alt=\"icon-img\">";
        }
        return $template;
    }

    public function geticon()
    {
        $template= "https://cdn.cloudflare.steamstatic.com/steam/apps/";
        $template.= $this->appid;
        $template.= "/header.jpg";
        return $template;
    }
    public function printCard()
    {
        $image = $this->geticon();
        $title = $this -> name;
        $content = "playtime: ". $this->playtime_forever;
        $custom = $this ->getlogo();
        $genre ='1';
        $flag = '1';

        include __DIR__ ."/../Views/card.php";
    }
}
// $Babylon = new Movie('9381','Babylon','en','A veteran-turned-mercenary is hired to take a young woman with a secret from post-apocalyptic Eastern Europe to New York City.','5.601','https://image.tmdb.org/t/p/w342/kt9nqD0uOar8IVE9191HXhWOXKI.jpg');
// var_dump($Babylon);

// $nuovoFilm = new Movie();
// var_dump($nuovoFilm);

$gamesString = file_get_contents(__DIR__.'/steam_db.json');
$gameList = json_decode($gamesString, true);
$gamess=[];

foreach ($gameList as $item){
   
   $games[] = new Game($item['appid'], $item['name'], $item['playtime_forever'],$item['img_icon_url'],$item['img_logo_url']);
}


?>