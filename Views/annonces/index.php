<h1>Liste de nos produits</h1>
<?php foreach ($annonces as $annonce){ ?>
    <article>
        <h2><a href="/MVC_DB/public/Index.php?p=annonces/lire/<?= $annonce->id ?>"><?= $annonce->titre ?></a></h2>
        <div><?= $annonce->description ?></div>
    </article>
<?php } ?>