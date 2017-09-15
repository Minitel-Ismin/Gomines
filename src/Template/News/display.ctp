
<?= $this->Html->css('news') ?>

<div class="container">
	<div class="col-md-10 col-md-offset-1">
        <?php foreach ($news as $new): ?>
            <h1><?= $new->title ?></h1>
            <p class="author">Ecrit par : <span ><?= $new->user['nom'] ?> <?= $new->user['prenom'] ?></span></p>
            <p><?= $new->text ?></p>
            
            <hr>
        <?php endforeach; ?>
    </div>
</div>
