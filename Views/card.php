<?php
$prezzo= rand(5,40);
?>
<div class="col-12 col-md-4 col-lg-3">
    <div class="card">
        <img src="<?= $image ?>" class="card-img-top my-ratio" style="height:60vh" alt="<?= $title ?>">
        <div class="card-body">
            <h5 class="card-title">
                <?= $title ?>
            </h5>
            <p class="card-text">
                <?= $content ?>
            </p>
            <span>prezzo: €<?=$prezzo?>.00</span>
            <div class="d-flex justify-content-between align-items-flex-start">
                <?= $custom ?>
               
                <div >
                    <small class="<?= $flag == 1 ? 'd-none' : '' ?>"><img src="<?= $flag ?>" alt="flagimg"></small>
                    <small class="<?= $genre == 1 ? 'd-none' : '' ?>">
                    <?= $genre ?>
                    </small>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .card{
        transition: 0.5s;
        height:90vh;
        cursor: pointer;
        border: 0;
    }
    .card:hover{
        transform: scale(1.05);
        z-index: 200;
        box-shadow: 0 0 10px white;
    }
</style>