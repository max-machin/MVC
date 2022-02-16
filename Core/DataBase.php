<?php
namespace App\Core;

use PDO;
use PDOException;

/**
 *? Class DataBase : Connexion à la base de données à l'aide de constante private,
 *? Paramétrage de PDO,
 *? Création d'une instance de connexion si non existante et retour de cette dernière 
 */
class DataBase extends PDO
{
    //Instance unique de la classe 
    private static $instance;

    //Informations de connexion à la base de données 
    private const DBHOST = 'localhost';
    private const DBUSER = 'root';
    private const DBPASS = '';
    private const DBNAME = 'mvc';

    /**
     * fonction de connexion à la base de données et paramétrage de PDO
     */
    private function __construct()
    {
        //DSN de connexion
        $_dsn = 'mysql:dbname='. self::DBNAME . ';host='. self::DBHOST;

        //On appelle le constructeur de la classe PDO
        try{
            parent::__construct($_dsn , self::DBUSER, self::DBPASS);

            //On initalise les attributs PDO de préférence
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAME utf8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e){
            die($e->getMessage());
        }
        
    }

    /**
     * fonction d'instanciation si non exitante,
     * sinon retour de cette dernière
     *
     * @return void
     */
    public static function getInstance()
    {
        if(self::$instance === NULL){
            self::$instance = new DataBase();
        }

        return self::$instance;
    }
}