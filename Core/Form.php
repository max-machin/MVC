<?php
namespace App\Core;

/**
 *? Class contenant les méthodes de génération des formulaires 
 *
*/
class Form
{
    public $formCode = '';


    /**
     * Génère le formulaire HTML
     * @return string
     */
    public function create()
    {
        return $this->formCode;

    }


    public function validate(array $form , array $champs)
    {
        // On parcourt les champs
        foreach ($champs as $champ)
        {
            // Si le champ est absent ou vide dans le formulaire 
            if ( !isset($form[$champ]) || empty($form[$champ]))
            {
                // On sort en retournant false
                return false;
            }
        }

        return true;
    }


    /**
     * Ajoute les attributs envoyer à la balise HTML
     * @param array $attributs Tableau associatif ['class' => 'form-control', 'required' => true]
     * @return string Chaîne de caractère générée
     */
    public function addAttributs(array $attributs)
    {
        // On initialise une chaîne de caractère 
        $str = '';

        // On liste les attributs "courts"
        $courts = ['checked' , 'disabled' , 'readonly', 'multiple', 'required', 'autofocus', 'novalidate', 'formnovalidate'];

        // On boucle sur la liste d'attributs
        foreach($attributs as $attribut => $valeur)
        {
            // Si l'attribut est dans la liste des attributs courts
            if(in_array($attributs, $courts) && $valeur == true)
            {
                $str .= " $attribut";
            } else {
                // On ajoute attribut='valeur'
                $str .= " $attribut='$valeur'";
            }
        }

        return $str;
    }

    

    /**
     * Balise d'ouverture du formulaire
     *
     * @param string $methode Méthode du formulaire (post ou get)
     * @param string $action Action du formulaire
     * @param array $attributs Attribut
     * @return Form 
     */
    public function startForm(string $methode = 'post', string $action = '#' , array $attributs = [])
    {
        // On crée la balise form
        $this->formCode .="<form action='$action' method='$methode'"; 
        

        // On ajoute les attributs éventuels
        $this->formCode .= $attributs ? $this->addAttributs($attributs).'>' : '>';
    
        return $this;
    }

    /**
     * Balise de fermeture du formulaire
     *
     * @return self 
     */
    public function endForm():self
    {
        $this->formCode .= '</form>';
        return $this;
    }


    /**
     * Ajout d'un label
     *
     * @param string $for
     * @param string $texte
     * @param array $attributs
     * @return void
     */
    public function addLabelFor(string $for, string $texte, array $attributs = [])
    {
        // On ouvre la balise HTML <label>
        $this->formCode .= "<label for ='$for ' ";

        // On ajoute les attributs 
        $this->formCode .= $attributs ? $this->addAttributs($attributs) : '';

        // On ajoute le texte 
        $this->formCode .= ">$texte</label>";

        return $this;
    }

    /**
     * Ajout d'un input
     *
     * @param string $type
     * @param string $nom
     * @param array $attributs
     * @return void
     */
    public function addInput(string $type, string $nom , array $attributs = [])
    {
        // On ouvre la balise 
        $this->formCode .= "<input type='$type' name='$nom'";

        // On ajoute les attributs
        $this->formCode .= $attributs ? $this->addAttributs($attributs).'>' : '>';

        return $this;

    }

    /**
     * Ajout d'un textarea
     *
     * @param string $nom
     * @param string $valeur
     * @param array $attributs
     * @return void
     */
    public function Textarea(string $nom, string $valeur = '' , array $attributs = []) 
    {
         // On ouvre la balise HTML <textarea>
         $this->formCode .= "<textarea for ='$nom'>";

         // On ajoute les attributs 
         $this->formCode .= $attributs ? $this->addAttributs($attributs) : '';
 
         // On ajoute le texte 
         $this->formCode .= ">$valeur</textarea>";
 
         return $this;
    }

    /**
     * Ajout d'un select
     *
     * @param string $nom
     * @param array $options
     * @param array $attributs
     * @return void
     */
    public function addSelect(string $nom, array $options, array $attributs = [])
    {
        // On ouvre la balise HTML <select>
        $this->formCode .= "<select name='$nom'";

        // On ajoute les attributs
        $this->formCode .= $attributs ? $this->addAttributs($attributs).'>' : '>';

        // On ajoute les options
        foreach($options as $valeur => $texte) 
        {
            $this->formCode .= "<option value='$valeur'>$texte</option>";
        }

        // On ferme le select
        $this->formCode .= '</select>';

        return $this;

    }

    /**
     * Ajout d'un bouton
     *
     * @param string $texte
     * @param array $attributs
     * @return void
     */
    public function addButton(string $texte, array $attributs = [])
    {
        // On ouvre 
        $this->formCode .= '<button ';

        $this->formCode .= $attributs ? $this->addAttributs($attributs) : '';

        $this->formCode .= ">$texte</button>";

        return $this;
    }
}