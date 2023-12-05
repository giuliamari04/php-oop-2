<?php
include __DIR__ ."/Views/header.php";
include __DIR__ ."/Model/Movie.php";

?>
<section class="container text-light ">
    <h2>Movie</h2>
    <div class="row gy-4 mt-3">
        <?php 
        foreach($movies as $movie){
            $movie->printCard();
        }
        ?>
    </div>
</section>

<?php
include __DIR__ ."/Views/footer.php";
?>