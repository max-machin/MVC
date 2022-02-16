<?php
namespace App\Controllers;

/**
 *? Class MainController : Controller du main, renvoyant dans la function 'render' de "Controller.php" le fichier
 *? dans lequel envoyé la view (main/index.php), les éventuels données à transmettre, ainsi que la template concernée
 */
class MainController extends Controller
{
    /**
     * function index, permettant d'afficher les données/template dans la view "main"
     *
     * @return view
     */
    public function index()
    {
        $this->render('main/index' , [] , 'home');
    }
}