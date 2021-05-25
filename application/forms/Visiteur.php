<?php

class Application_Form_Visiteur extends Zend_Form
{
    public function init() {
        
        $id = new Zend_Form_Element_Text('id');
        $id->setLabel('ID')
            ->setRequired(true);
        
        $nom = new Zend_Form_Element_Text('nom');
        $nom->setLabel('Nom')
                ->setRequired(true);
        $prenom = new Zend_Form_Element_Text('prenom');
        $prenom->setLabel('Prenom')
                ->setRequired(true);
        $login = new Zend_Form_Element_Text('login');
        $login->setLabel('Login')
                ->setRequired(true);
        $role = new Zend_Form_Element_Text('role');
        $role->setLabel('Role')
                ->setRequired(true);
        
        $btEnvoyer = new Zend_Form_Element_Submit('envoyer');
        
        $this->addElements(array($id,$nom,$prenom,$login,$role,$btEnvoyer));
    }
}

?>