<?php $v->layout("_theme"); ?>

<div class="error">
    <h2>Ooooooops erro <?= $error; ?></h2>
    <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi facere laboriosam voluptas temporibus earum saepe.</p>
</div>

<?php $v->start("sidebar"); ?>
<a href="<?= url(); ?>" title="Voltar ao Inicio!">Voltar</a>
<?php $v->end(); ?>