<?php

require_once '../autoloader.php';

class FormInscription extends Zend_Form {

    public function init() {
        //controle de saisie
        $alphabetEspace = new Zend_Validate_Alpha(TRUE);
        $alphabetEspace->setMessage("Saisir des caractères alphabétiques et l'espace");

        $ip = new Zend_Validate_Ip();
        $ip->setMessage("adresse IP invalide");

        $ageTrancheValide = new Zend_Validate_Between(array('min' => 7, 'max' => 77, 'inclusive' => TRUE));
        $ageTrancheValide->setMessage("Votre age doit être entre 7 et 77 ans");

        $ageNumerique = new Zend_Validate_Digits();
        $ageNumerique->setMessage("Saisir un nombre entier");

        $pwdValide = new Zend_Validate_Regex('((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20})');
        $pwdValide->setMessage("6 à 20 caracteres, au moins 1 chiffre, au moins une majuscule");

        $dateValidator = new Zend_Validate_Date();
        $dateValidator->setMessage("Le format de date n'est pas correcte. yyyy-mm-dd");


        //fin controle de saisie
        $this->setName('Inscription');


        $pseudo = new Zend_Form_Element_Text('pseudo');
        $pseudo->setLabel('Pseudonyme: ')
                ->setRequired()
                ->addValidator($alphabetEspace);

        $nom = new Zend_Form_Element_Text('nom');
        $nom->setLabel('Nom: ')
                ->setRequired()
                ->addValidator($alphabetEspace);

        $prenom = new Zend_Form_Element_Text('prenom');
        $prenom->setLabel('Prenom: ')
                ->setRequired()
                ->addValidator($alphabetEspace);

        $mdp = new Zend_Form_Element_Password('motdepasse');
        $mdp->setLabel('Mot de passe: ')
                ->setRequired()
                ->addValidator($pwdValide);
               


        $civilite = new Zend_Form_Element_Select('civilite');
        $civilite->setLabel('Civilite')
                ->addMultiOptions(array(0 => 'M', 1 => 'MME'))
                ->setRequired();

        $adrIP = new Zend_Form_Element_Text('ip');
        $adrIP->setLabel('Adresse IP V4: ')
                ->setRequired()
                ->addValidator($ip);

        $age = new Zend_Form_Element_Text('age');
        $age->setLabel('Age: ')
                ->setRequired()
                ->addValidator($ageTrancheValide)
                ->addValidator($ageNumerique);

        $adresse = new Zend_Form_Element_Text('adresse');
        $adresse->setLabel('Adresse: ');

        $cp = new Zend_Form_Element_Text('cp');
        $cp->setLabel('Code Postal: ');

        $ville = new Zend_Form_Element_Text('ville');
        $ville->setLabel('Ville: ');



        $date = new Zend_Form_Element_Text('date');
        $date->setLabel("Date d'embauche: ");
        $date->addValidator($dateValidator);


        $btEnvoyer = new Zend_Form_Element_Submit('btEnregistrer');
        $btEnvoyer->setLabel('Inscrire');
        $this->addElements(array($pseudo, $nom, $prenom, $mdp, $civilite, $adrIP, $age, $adresse, $cp, $ville, $date, $btEnvoyer))
                ->setMethod('post')
                ->setAction('tp01.php');
    }

}

$view = new Zend_View();
$form = new FormInscription();
if (!$_POST) {
// rendu du formulaire vierge
    echo $form->render($view);
} else
if (!$form->isValid($_POST)) {
// rendu du formulaire rempli , avec des erreurs
    echo $form->render($view);
} else {
// les données du formulaire sont valides. on peut les exploiter...
    echo $form->render($view);
    var_dump($form->getValues());
}
?> 
