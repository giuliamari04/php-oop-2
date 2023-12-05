<?php
include __DIR__ ."/Genre.php";
class Product
{
    protected int $id;
    protected string $title;
    protected string $thumbnailUrl;

    function __construct($id, $title, $thumbnailUrl)
    {
        $this->id = $id;
        $this->title = $title;
        $this->thumbnailUrl = $thumbnailUrl;
    }

    public function printCard()
    {
        $image = $this->thumbnailUrl;
        $title = $this->title;
        $content = $this->getContent();
        $custom = $this->getCustom();   
        $flag = $this->getFlag();   
        $genre =$this->getGenre();   

        include __DIR__ . "/../Views/card.php";
    }

    protected function getContent()
    {
        return '';
    }

    protected function getCustom()
    {
        return '';
    }

    protected function getFlag()
    {
        return '';
    }
    protected function getGenre(){
        return'';
    }
}

class Movie extends Product
{
    private string $original_language;
    private string $overview;
    private float $vote_average;

    public Genre $genre;

    function __construct($id, $title, $original_language, $overview, $vote_average, $thumbnailUrl, $genres)
    {
        parent::__construct($id, $title, $thumbnailUrl);
        $this->original_language = $original_language;
        $this->overview = $overview;
        $this->vote_average = $vote_average;
        $this->genre = $genres;
    }

    protected function getContent()
    {
        return substr($this->overview, 0, 100) . '...';
    }
    protected function getCustom()
    {
        $vote = ceil($this->vote_average / 2);
        $template = "<p>";
        for ($n = 1; $n <= 5; $n++) {
            $template .= $n <= $vote ? '<i class="fa-solid fa-star"></i>' : '<i class="fa-regular fa-star"></i>';
        }
        $template .= "</p>";
        return $template;
    }

    protected function getFlag()
    {
        $template = "https://flagcdn.com/w20/";
        if ($this->original_language === 'en') {
            $template .= 'gb';
        } elseif ($this->original_language === 'ja') {
            $template .= 'jp';
        } else {
            $template .= $this->original_language;
        }

        $template .= ".png";
        return $template;
    }

    protected function getGenre(){
        return  $this->genre->name;
    }
}

class Book extends Product
{
    private array $authors;
    private string $longDescription;
    private string $status;

    function __construct($id, $title, $authors, $longDescription, $status, $thumbnailUrl)
    {
        parent::__construct($id, $title, $thumbnailUrl);
        $this->authors = $authors;
        $this->longDescription = $longDescription;
        $this->status = $status;
    }

    protected function getContent()
    {
        // Implementazione specifica per Book
        return substr($this->longDescription, 0, 100) . '...';
    }

    protected function getCustom()
    {
        // Implementazione specifica per Book
        $template = "<span>";
        for ($i = 0; $i < count($this->authors); $i++) {
            $template .= " " . $this->authors[$i] . " ";
        }
        $template .= "</span>";
        return $template;
    }

    protected function getFlag()
    {
        // Implementazione specifica per Book
        return '1'; // Se flag è 1, restituisce '1'
    }
    protected function getGenre(){
        return  '1';
    }
    
}
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
    protected function getGenre(){
        return  '1';
    }
}

$movieString = file_get_contents(__DIR__.'/movie_db.json');
$movieList = json_decode($movieString, true);
$movies=[];
$genres = ["Fantasy", "Horror", "Mystery", "Thriller", "Drama", "Action", "Comedy"];
foreach ($movieList as $item){
    $randgenre = $genres[rand(0,count($genres)-1)];
   $movies[] = new Movie($item['id'], $item['title'], $item['original_language'],$item['overview'],$item['vote_average'],$item['poster_path'],New Genre($randgenre) );
}

$booksString = file_get_contents(__DIR__.'/books_db.json');
$bookList = json_decode($booksString, true);
$books=[];
foreach ($bookList as $item){
   $books[] = new Book($item['_id'], $item['title'], $item['authors'],$item['longDescription'],$item['status'],$item['thumbnailUrl']);
}

$gamesString = file_get_contents(__DIR__.'/steam_db.json');
$gameList = json_decode($gamesString, true);
$games=[];

foreach ($gameList as $item){
   
   $games[] = new Game($item['appid'], $item['name'], $item['playtime_forever'],$item['img_icon_url'],$item['img_logo_url']);
}
?>
