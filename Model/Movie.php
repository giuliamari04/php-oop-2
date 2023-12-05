<?php
include __DIR__ ."/Genre.php";
class Movie
{
    private int $id;
    private  string $title;
    private string $original_language;
    private string $overview;
    private float $vote_average;
    private string $poster_path;

    public Genre $genre;

    function __construct($id, $title, $original_language, $overview, $vote_average, $poster_path, $genres)
    {
        $this->id = $id;
        $this->title = $title;
        $this->original_language = $original_language;
        $this->overview = $overview;
        $this->vote_average = $vote_average;
        $this->poster_path = $poster_path;
        $this->genre = $genres;


    }

    public function getVote(){
        $vote = ceil($this->vote_average / 2);
        $template ="<p>";
        for($n=1;$n<=5;$n++){
            $template.=$n<=$vote? '<i class="fa-solid fa-star"></i>':'<i class="fa-regular fa-star"></i>';
        }
        $template .="</p>";
        return $template;
    }

    public function getFlag(){
        $template ="https://flagcdn.com/w20/";
        if($this->original_language ==='en'){
            $template .= 'gb';
        }
        elseif($this->original_language === 'ja'){
            $template.= 'jp';
        }
        else{
            $template.= $this->original_language;
        }
        
        $template.= ".png"; 
        return $template;
    }
    public function printCard()
    {
        $image = $this->poster_path;
        $title = $this -> title;
        $content = substr($this->overview,0,100).'...';
        $custom = $this -> getVote();
        $genre = $this ->genre->name;
        $flag = $this->getFlag();

        include __DIR__ ."/../Views/card.php";
    }
}
// $Babylon = new Movie('9381','Babylon','en','A veteran-turned-mercenary is hired to take a young woman with a secret from post-apocalyptic Eastern Europe to New York City.','5.601','https://image.tmdb.org/t/p/w342/kt9nqD0uOar8IVE9191HXhWOXKI.jpg');
// var_dump($Babylon);

// $nuovoFilm = new Movie();
// var_dump($nuovoFilm);

$movieString = file_get_contents(__DIR__.'/movie_db.json');
$movieList = json_decode($movieString, true);
$movies=[];
$genres = ["Fantasy", "Horror", "Mystery", "Thriller", "Drama", "Action", "Comedy"];
// $action = new Genre('Action');
// $comedy = new Genre('Comedy');
foreach ($movieList as $item){
    $randgenre = $genres[rand(0,count($genres)-1)];
    //var_dump($randgenre);
   $movies[] = new Movie($item['id'], $item['title'], $item['original_language'],$item['overview'],$item['vote_average'],$item['poster_path'],New Genre($randgenre) );
}
//var_dump($movies);
//var_dump($movies[0]);
//echo $movies[0]->title;


?>