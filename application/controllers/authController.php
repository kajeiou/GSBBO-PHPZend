<?php

class AuthController extends Zend_Controller_Action {

    public function loginAction() {
        $form = new Application_Form_Login();
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $user = $form->getValue('user');
                $mdp = $form->getValue('mdp');
                $authAdapter = $this->getAuthAdapter();
                $authAdapter->setIdentity($user)
                        ->setCredential($mdp)
                        ->setCredentialTreatment('MD5(?)');
                
                $auth = Zend_Auth::getInstance();
                $result = $auth->authenticate($authAdapter);

                if ($result->isValid()) {
                    $identity = $authAdapter->getResultRowObject();
                    $authStorage = $auth->getStorage();
                    $authStorage->write($identity);
                    $this->_helper->redirector->gotoUrl('visiteur/index');
                    //$this->_helper->redirector->gotoUrl('visiteur/accueil');
                } else {
                    $this->view->errorMessage = 'echec authentification';
                }
            }
        }
    }

    public function logoutAction() {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector->gotoUrl('visiteur/index');
    }

    public function getAuthAdapter() {
        $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
        $authAdapter->setTableName('visiteur')
                ->setIdentityColumn('login')
                ->setCredentialColumn('mdp');
        return $authAdapter;
    }

}

?>