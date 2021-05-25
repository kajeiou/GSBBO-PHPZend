<?php

class Application_Form_Login extends Zend_Form {

    public function init() {
        $user = new Zend_Form_Element_Text('user');

        $user->setLabel('Utilisateur: ')
                ->setRequired();

        $mdp = new Zend_Form_Element_Password('mdp');

        $mdp->setLabel('Mot de passe:')
                ->setRequired();


        $connexion = new Zend_Form_Element_Submit('connexion');
        $connexion->setLabel('Se connecter');

        $this->addElements(array($user, $mdp, $connexion));
    }

}

?>