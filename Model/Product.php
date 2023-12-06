<?php

include __DIR__ . "/../traits/DrowCard.php";
include __DIR__ . "/Genre.php";
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
        $this->drawCard();
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

    protected function getGenre()
    {
        return '';
    }

    protected function getlogo(){
        return'';
    }
}

class Movie extends Product
{
    use DrowCard;

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
    protected function getImg(){
        return $this->thumbnailUrl;
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

    protected function getGenre()
    {
        return  $this->genre->name;
    }
}

class Book extends Product
{
    use DrowCard;

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
        return substr($this->longDescription, 0, 100) . '...';
    }

    protected function getImg(){
        return $this->thumbnailUrl;
    }
    protected function getCustom()
    {
        $template = "<span>";
        for ($i = 0; $i < count($this->authors); $i++) {
            $template .= " " . $this->authors[$i] . " ";
        }
        $template .= "</span>";
        return $template;
    }

    protected function getFlag()
    {
        return '1'; // Se flag è 1, restituisce '1'
    }

    protected function getGenre()
    {
        return  '1';
    }
}

class Game extends Product
{
    use DrowCard;

    private int $appid;
    private string $name;
    private string $playtime_forever;
    private string $img_icon_url;
    private string $img_logo_url;

    public function __construct(int $id, string $title, string $playtime_forever, string $thumbnailUrl, string $img_logo_url)
    {
        parent::__construct($id, $title, $thumbnailUrl);
        $this->playtime_forever = $playtime_forever;
        $this->img_logo_url = $img_logo_url;
    }

    protected function getContent()
    {
        return "playtime: ".$this->playtime_forever;
    }
    protected function getCustom()
    {
        if ($this->id == 240 || $this->id == 280) {
            $template = " ";
        } else {
            $template = "<img src= \"http://media.steampowered.com/steamcommunity/public/images/apps/";
            $template .= $this->id;
            $template .= "/";
            $template .= $this->thumbnailUrl;
            $template .= ".jpg\" alt=\"icon-img\">";
        }
        return $template;
    }
    protected function getFlag()
    {
        return '1'; // Se flag è 1, restituisce '1'
    }
    
    public function getImg()
    {
        $template = "https://cdn.cloudflare.steamstatic.com/steam/apps/";
        $template .= $this->id;
        $template .= "/header.jpg";
        return $template;
    }

    public function getGenre()
    {
        return  '1';
    }

    public function printCard()
    {
        $this->drawCard();
    }
}

$movieString = file_get_contents(__DIR__ . '/movie_db.json');
$movieList = json_decode($movieString, true);
$movies = [];
$genres = ["Fantasy", "Horror", "Mystery", "Thriller", "Drama", "Action", "Comedy"];
foreach ($movieList as $item) {
    $randgenre = $genres[rand(0, count($genres) - 1)];
    $movies[] = new Movie($item['id'], $item['title'], $item['original_language'], $item['overview'], $item['vote_average'], $item['poster_path'], new Genre($randgenre));
}

$booksString = file_get_contents(__DIR__ . '/books_db.json');
$bookList = json_decode($booksString, true);
$books = [];
foreach ($bookList as $item) {
    $books[] = new Book($item['_id'], $item['title'], $item['authors'],$item['longDescription'],$item['status'],$item['thumbnailUrl']);
}


$gamesString = file_get_contents(__DIR__.'/steam_db.json');
$gameList = json_decode($gamesString, true);
$games=[];

foreach ($gameList as $item){
   
   $games[] = new Game($item['appid'], $item['name'], $item['playtime_forever'],$item['img_icon_url'],$item['img_logo_url']);
}


