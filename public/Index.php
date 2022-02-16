<?php
use App\Autoloader;
use App\Core\Main;
use App\Models\AnnoncesModel;

// On définit une constante contenant le dossier racine du projet 
define('ROOT', dirname(__DIR__));

// On importe l'autoloader
require_once ROOT.'/Autoloader.php';
Autoloader::register();

// On instancie le main (le routeur)
$app = new Main();

// On démarre l'application 
$app->start();


// Création d'une nouvelle annonce (nouveau produit dans ce cas précis)
$model = new AnnoncesModel();

$produit = $model
    ->setTitre('Gloce')
    ->setDescription('Pas pour les gosses')
    ->setActif(20);

$produit->create($model);



