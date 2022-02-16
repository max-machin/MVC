<?php
namespace App\Controllers;


/**
 *? Class Controller : class permettant la gestion de l'affichage des données dans les views
 *? à l'aide des fonctions ob_start et ob_get_clean permettant de stocker en mémoire les informations à afficher
 *? Cette classe créera également les chemin d'accés aux views en fonction de la demande url 
 *? On pourra également lui renseigner une template qui se situera dans les views
 */
abstract class Controller
{
    /**
     * Function permettant l'affichage des données dans la view
     *
     * @param string $fichier fichier dans lequel afficher la vue
     * @param array $donnees donnees à afficher dans la view
     * @return void
     */
    public function render(string $fichier, array $donnees = [], string $template = 'default')
    {
        // On extrait le contenu de $donnees
        extract($donnees);

        // * La fonction ob_start permet de démarrer le buffer de sortie
        // * A partir de ce point toute sortie est conservée en mémoire
        ob_start();
        // On crée le chemin vers la vue
        require_once ROOT.'/Views/'.$fichier.'.php';

        // * ob_get_clean permet de stocker le buffer dans la variable $contenu 
        $contenu = ob_get_clean();

        // On crée le chemin vers la template
        require_once ROOT.'/Views/'.$template.'.php';
    }
}