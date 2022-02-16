<?php
namespace App\Controllers;

Use App\Core\Form;

/**
 *? Class UsersController : Classe permettant de générer un formulaire (Core/Form.php)
 *? et de l'afficher dans la view (users/login.php)
 */
class UsersController extends Controller
{
    /**
     * function login : Génération du formulaire à l'aide des méthode de la class Form (Core/Form.php)
     * et affichage de ce dernier dans la view (users/login.php)
     *
     * @return view
     */
    public function login()
    {
        $form = new Form;

        $form->startForm();
        $form->addLabelFor('email' , 'E-mail :');
        $form->addInput('email' , 'email', ['class' => 'form-control', 'id' => 'email',]);
        $form->addLabelFor('pass' , 'Mot de passe :');
        $form->addInput('password' , 'password', ['id' => 'pass', 'class' => 'form-control',]);
        $form->addButton('Me connecter' , ['class' => 'btn btn-primary']);
        $form->endForm();
        
        $this->render('users/login' , ['loginForm' => $form->create()]);
            
    }

    public function register()
    {
        $form = new Form;

        $form->startForm();
        $form->addLabelFor('email', 'E-mail :');
        $form->addInput('email', 'email', ['id' => 'email' ,'class' => 'form-control',]);
        $form->addLabelFor('password', 'Mot de passe :');
        $form->addInput('password', 'password', ['id' => 'password','class' => 'form-control']);
        $form->addButton('S\'inscrire', ['class' => 'btn btn-primary']);
        $form->endForm();

        $this->render('users/register' , ['registerForm' => $form->create()] , 'default');
    }

}