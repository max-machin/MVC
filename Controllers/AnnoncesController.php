<?php
namespace App\Controllers;

use App\Models\AnnoncesModel;

/**
 *? Class AnnoncesController : S'occupe de l'instanciation des modéles 
 *? en fonction des méthodes et paramètres passés et retourner dans les vues 
 */
class AnnoncesController extends Controller
{
    /**
     * Cette méthode affichera une page listant toutes les annonces de la base de données
     *
     * @return view
     */
    public function index()
    {
       // On instancie le modèle correspondant à la table 'annonces'
       $annoncesModel = new AnnoncesModel();
       // On récupère la totalité des annonces grâce une requête préparé dans 'Model.php'
       $annonces = $annoncesModel->findAll();
       // On envoie les informations à la vue
       $this->render('annonces/index', compact('annonces'));
    }

    /**
     * Cette méthode permettra d'afficher le contenu d'une annonce dans une 'page individuelle';
     * 
     * @param integer $id
     * @return view
     */
    public function lire(int $id)
    {
        // On instancie le modèle
        $annoncesModel = new AnnoncesModel();

        // On va chercher 1 annonce
        $annonce = $annoncesModel->find($id);

        // On envoie à la vue
        $this->render('annonces/lire', compact('annonce'));
    }
}