<?php
namespace App;


/**
 *? Class Autoloader : Permets le chargement dynamique des class appelé lors d'une action
 */
class Autoloader 
{
    /**
     * Fonction register : Méthode permettant de récupérer le nom de la class concernée (spl_autoload_register)
     * et d'éxecuter la méthode 'autoload' défini plus bas
     * @return void
     */
    static function register()
    {
        spl_autoload_register([
            //Va chercher la classe concernéé
            __CLASS__,
            //Lance la methode autoload
            'autoload'
        ]);
    }

    /**
     * Fonction autoload : permets de gérer le chemin d'accès 
     *
     * @param string $class
     * @return void
     */
    static function autoload($class)
    {
        //On récupere dans $class la totalité du namespace de la classe concernée
        //On retire App\ 
        $class = str_replace(__NAMESPACE__ . '\\', '' , $class);

        //On remplace les \\ par des /
        $class = str_replace('\\', '/', $class);

        
        //__DIR__ = Le dossier dans lequel se trouve l'autoloader' (dossier MVC_DB)
        $fichier = __DIR__ . '/' . $class . '.php';
        //On vérifie si le chemin existe 
        if( file_exists($fichier))
        {
            require_once $fichier;
        } else {
            header('location: index?p=');
        }
    }
}