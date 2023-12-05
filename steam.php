<?php
include __DIR__ ."/Views/header.php";
include __DIR__ ."/Model/Steam.php";
?>
<section class="container text-light ">
    <h2>Giochi</h2>
    <div class="row gy-4 mt-3">
        <?php 
        foreach($games as $game){
            $game->printCard();
        }
        ?>
    </div>
</section>

<?php
include __DIR__ ."/Views/footer.php";
?>