<?php

class Book
{
    private int $_id;
    private  string $title;
    private array $authors;
    private string $longDescription;
    private string $status;
    private string $thumbnailUrl;


    function __construct($_id, $title, $authors, $longDescription, $status, $thumbnailUrl)
    {
        $this->_id = $_id;
        $this->title = $title;
        $this->authors = $authors;
        $this->longDescription = $longDescription;
        $this->status = $status;
        $this->thumbnailUrl = $thumbnailUrl;
    }
    
    public function getauthors(){
        $template="<span>";
        for($i= 0;$i<count($this->authors);$i++){
            $template.= " ".$this->authors[$i]." ";
        }
        $template.="</span>";
        return $template;
    }
    public function printCard()
    {
        $image = $this->thumbnailUrl;
        $title = $this -> title;
        $content = substr($this->longDescription,0,100).'...';
        $custom = $this ->getauthors();
        $genre = $this ->status;
        $flag = '';

        include __DIR__ ."/../Views/card.php";
    }
}
// $Babylon = new Movie('9381','Babylon','en','A veteran-turned-mercenary is hired to take a young woman with a secret from post-apocalyptic Eastern Europe to New York City.','5.601','https://image.tmdb.org/t/p/w342/kt9nqD0uOar8IVE9191HXhWOXKI.jpg');
// var_dump($Babylon);

// $nuovoFilm = new Movie();
// var_dump($nuovoFilm);

$booksString = file_get_contents(__DIR__.'/books_db.json');
$bookList = json_decode($booksString, true);
$books=[];
//$genres = ["Fantasy", "Horror", "Mystery", "Thriller", "Drama", "Action", "Comedy"];
// $action = new Genre('Action');
// $comedy = new Genre('Comedy');
foreach ($bookList as $item){
   // $randgenre = $genres[rand(0,count($genres)-1)];
    //var_dump($randgenre);
   $books[] = new Book($item['_id'], $item['title'], $item['authors'],$item['longDescription'],$item['status'],$item['thumbnailUrl']);
}


?>