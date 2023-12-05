<?php
include __DIR__ ."/Views/header.php";
include __DIR__ ."/Model/product.php";
?>
<section class="container text-light ">
    <h2>Book</h2>
    <div class="row gy-4 mt-3">
        <?php 
        foreach($books as $book){
            $book->printCard();
        }
        ?>
    </div>
</section>

<?php
include __DIR__ ."/Views/footer.php";
?>