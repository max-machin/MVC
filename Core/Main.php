<?php
namespace App\Core;

use App\Controllers\MainController;


/**
 * ? Routeur principal
 */
class Main
{
    public function start()
    {

        
        // On retire le "trailing slash" éventuel de l'URL
        // On récupère l'URL
        $uri = $_SERVER['REQUEST_URI'];

        // On vérifie que $uri n'est pas vide et fini par un "/"
        if ( !empty ($uri) && $uri != '/' && $uri[-1] === "/")
        {
            
            $uri = substr($uri, 0, -1);
            // On envoie un code de redirection permanente
            http_response_code(301);

            // On redirige vers l'URL sans "/" 
            header('location: '.$uri);
            
        } 
        
        // On gère les paramètres de l'URL
        // p = controlleur/methode/paramètres
        // On sépare les paramètres dans un tableau
        $params = [];
        if( isset($_GET['p'])){
        $params = explode('/', $_GET['p']);
        }
        

        if ($params[0] !== '')
        {
            // On a au moins 1 paramètre
            // On récupère le nom du Controller à instancier
            // On met une majuscule à la première lettre, on ajoute le namespace complet avant et on ajoute le Controller aprés
            $controller = '\\App\\Controllers\\'.ucfirst(array_shift($params)).'Controller';

            // On instancie le controller
            $controller = new $controller();
            var_dump($controller);

            // On récupère le 2ème paramètre de l'URL
            $action = (isset($params[0])) ? array_shift($params) : 'index';
        
            if(method_exists($controller, $action)){
                //Si il reste des paramètres on les passent à la méthode
                (isset($params[0])) ? call_user_func_array([$controller, $action], $params) : $controller->$action();
            } else {
                header('location: index?p=');
                echo "La page recherchée n'existe pas";
                http_response_code(404);
                
            }
        } else {
            // On a pas de paramètres, on instancie le Controller par défault
            $controller = new MainController();
            $controller->index();

        }
    }
}
