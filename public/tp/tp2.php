<?php
require_once '../autoloader.php'; 
class FormLogin extends Zend_Form {
    public function init() {
        
        $this->setName('Login');
        
        $userName = new Zend_Form_Element_Text('userName');
        
//rend en HTML : <input type=text name=userName…>
        $userName->setLabel('Nom: ')
                ->setRequired(); 
        
        $adresse = new Zend_Form_Element_Password('adresse');
        
        $adresse->setLabel('Adresse:')
                ->setRequired();
        
        
        $sms = new Zend_Form_Element_Text('adresse');
        
        $sms->setLabel("Code SMS: ") 
                -> setRequired();
        $login = new Zend_Form_Element_Submit('login');
        $login->setLabel('Envoyer');

        $this->addElements(array($userName, $password,$sms, $login))
                ->setMethod('post')
                ->setAction('tp01.php');  
    }
}

$view = new Zend_View();
$form = new FormLogin();
if (!$_POST) {                      
// rendu du formulaire vierge
    echo $form->render($view);
} else
if (!$form->isValid($_POST)) {      
// rendu du formulaire rempli et erreurs
    echo $form->render($view);
} else {                            
// formulaire valide. données postées
    echo $form->render($view);
    //var_dump($form->getValues());
    
   
    $VarUsername= $_POST['userName'];
    $VarPassword = $_POST['password'];
    $VarSms= $_POST['sms']; 
}
?>

