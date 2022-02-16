<?php
namespace App\Models;

use App\Core\DataBase;

/**
 *? Class Model contenant les requêtes génériques et la connexion à la base de données
 */
class Model extends DataBase 
{
    //Table de la base de donnée
    protected $table;

    //Instance de la Database
    private $database;


    /**
     * Gestion des préparations et execute des requetes en fonctions des attributs
     *
     * @param [type] $sql
     * @param array|null $attributs
     * @return void
     */
    public function requete($sql, ?array $attributs = null){
    
        //On récupere l'instance de database
        $this->database = DataBase::getInstance();


        //On vérifie si on a des attributs 
        if ($attributs !== null){
            //requête préparée
            $query = $this->database->prepare($sql);
            $query->execute($attributs);
            return $query;
        } else {
            //requête simple
            return $this->database->query($sql);
        }
    }


    /**
     * Trouver toutes les informations d'une table
     *
     * @return void
     */
    public function findAll()
    {
        $query = $this->requete('SELECT * FROM '. $this->table);
        return $query->fetchAll();
    }


    /**
     * Trouver des lignes de la table en fonction de critéres
     * findBy(['actif' => 15])
     * 
     * @param array $criteres
     * @return requete
     */
    public function findBy(array $criteres)
    {
        $champs = [];
        $valeurs = [];

        // On boucle pour éclater le tableau
        foreach($criteres as $champ => $valeur){
            //SELECT * FROM annonces where actif = ? AND signale = 0
            //bindValue(1, valeur);
            $champs[] = "$champ = ?";
            $valeurs[] = $valeur;
        }

        // On transforme le tableau champs en chaine de caractére
        $liste_champs = implode(' AND ', $champs);

        // On éxecute la requête 
        return $this->requete('SELECT * FROM '.$this->table.' WHERE '. $liste_champs, $valeurs)->fetchAll();
    }


    /**
     * Trouver une annonce selon un id
     * $annonce->find(10) recupère toutes les informations de l'annonce dont l'id = 13
     * 
     * @param integer $id
     * @return this->requete
     */
    public function find(int $id)
    {
        return $this->requete("SELECT * FROM $this->table WHERE id = $id")->fetch();
    }

    /**
     * Crée une annonce/user 
     *
     * @return void
     */
    public function create()
    {
        $champs = [];
        $inter = [];
        $valeurs = [];

        // On boucle pour éclater le tableau
        foreach($this as $champ => $valeur){
            // INSERT INTO annonces (titre, description, actif) values (?,?,?)
            
            if($valeur != null && $champ != 'database' && $champ != 'table'){
                $champs[] = $champ;
                $inter[] = "?";
                $valeurs[] = $valeur;
            }
            
        }

        //transformer la tableau champs en chaine de caractére
        $liste_champs = implode(', ', $champs);
        $liste_inter = implode(', ', $inter);

        //On éxecute la requête 
        // return $this->requete('INSERT INTO '.$this->table.' ('.$liste_champs.') VALUES ('.$liste_inter.')', $valeurs);
    }

    /**
     * Update des informations d'une annonce/user selon un id
     *
     * @return void
     */
    public function update()
    {
        $champs = [];
        $valeurs = [];

        // On boucle pour éclater le tableau
        foreach($this as $champ => $valeur){
            //UPDATE annonces SET titre = ?, description = ?, actif = ? WHERE id = ?
            
            if($valeur != null && $champ != 'database' && $champ != 'table'){
                $champs[] = "$champ = ?";
                $valeurs[] = $valeur;
            }
        }
        $valeurs[] = $this->id;
        //transformer la tableau champs en chaine de caractére
        $liste_champs = implode(', ', $champs);

        //On éxecute la requête 
        // return $this->requete('UPDATE '.$this->table.' SET '. $liste_champs .' WHERE id = ?', $valeurs);
    }

    /**
     * Supprime une annonce/user selon un id
     *
     * @param integer $id
     * @return requete
     */
    public function delete(int $id)
    {
        return $this->requete("DELETE FROM {$this->table} WHERE id =?", [$id]);
    }

    
    // public function hydrate($donnees)
    // {
    //     foreach($donnees as $key => $value)
    //     {
    //         //On récupère le nom du setter correspondant à $key
    //         $setter = 'set'.ucfirst($key);

    //         //On vérifie si le setter existe
    //         if(method_exists($this, $setter))
    //         {
    //             //On appelle le setter
    //             $this->$setter($value);
    //         }
    //     }
    //     return $this;
    // }
}