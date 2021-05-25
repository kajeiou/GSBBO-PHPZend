<?php

class VisiteurController extends Zend_Controller_Action {

    public function indexAction() {
        $lesVisiteurs = new Application_Model_DbTable_Visiteur();
        //$this->view->lesMarques=$lesMarques->fetchAll();
        $paginateur = new Zend_Paginator(new Zend_Paginator_Adapter_DbTableSelect($lesVisiteurs->select()));
        $paginateur->setItemCountPerPage(20);

        $currentPage = isset($_GET['page']) ? (int) htmlentities($_GET['page']) : 1;

        $paginateur->setCurrentPageNumber($currentPage);
        $this->view->lesVisiteurs = $paginateur;
    }

    public function init() {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            $this->_helper->redirector->gotoUrl('auth/login');
        }
    }
    public function voituresAction() {
        $idMarque = $this->_getParam('id',1);
        $lesMarques = new Application_Model_DbTable_Voiture();
        $uneMarque = $lesMarques->find($idMarque)->current();
        $lesMarques=$uneMarque->getVoitures();
        $this->view->nomDeMarque=$uneMarque->marque;
        $this->view->lesMarques=$lesMarques;
    }

    public function ajouterAction() {
        $form = new Application_Form_Visiteur();

        $idUnique = new Zend_Validate_Db_NoRecordExists(
                array('adapter' => Zend_Db_Table::getDefaultAdapter(),
            'table' => 'utilisateurs',
            'field' => 'id'));
        $idUnique->setMessage('Cet ID d\'utilisateur existe deja dans la base.');
        $form->id->addValidator($idUnique);



        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = $form->getValue('id');
                $nom = $form->getValue('nom');
                $prenom = $form->getValue('prenom');
                $login = $form->getValue('login');
                $role = $form->getValue('role');
                $lesVisiteurs = new Application_Model_DbTable_Visiteur();
                $lesVisiteurs->ajouterVisiteur($id, $nom, $prenom, $login, $role);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function modifierAction() {
        $form = new Application_Form_Visiteur();
        $form->id->setLabel('Identifiant (non modifiable)');
        $form->id->setAttrib('readonly', 'true');
        $form->id->setAttrib('style', 'pointer-events: none');

        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = $form->getValue('id');
                $nom = $form->getValue('nom');
                $prenom = $form->getValue('prenom');
                $login = $form->getValue('login');
                $role = $form->getValue('role');
                $lesVisiteurs = new Application_Model_DbTable_Visiteur();
                $lesVisiteurs->modifierVisiteur($id, $nom, $prenom, $login, $role);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            try {
                $lesVisiteurs = new Application_Model_DbTable_Visiteur();
                $id = $this->_getParam('id', $idPremiereVoiture = $lesVisiteurs->obtenirPremierVisiteur());
                
                
                $form->populate($lesVisiteurs->obtenirVisiteur($id));
            } catch (Exception $ex) {
                
             
            }
        }
    }
    public function langueAction() {
        $id = $this->_getParam('id',0);
        $tVisiteur = new Application_Model_DbTable_Visiteur();
        
        $unVisiteur = $tVisiteur->find($id)->current();
        $lesLanguesParlees=$unVisiteur->getLanguesParlees();
        $this->view->lesLanguesParlees=$lesLanguesParlees;
        $this->view->unVisiteur=$unVisiteur;
        
    }
    public function supprimerAction() {
        if ($this->getRequest()->isPost()) {
            $supprimer = $this->getRequest()->getPost('supprimer');
            if ($supprimer == 'Oui') {
                $id = $this->getRequest()->getPost('id');
                $lesVisiteurs = new Application_Model_DbTable_Visiteur();
                $lesVisiteurs->supprimerVisiteur($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $lesVisiteurs = new Application_Model_DbTable_Visiteur();
            $this->view->visiteur = $lesVisiteurs->obtenirVisiteur($id);
        }
    }

    public function listerAction() {
        $db = Zend_Db_Table::getDefaultAdapter();
        $query = "select idMarque,marque, count(*) as nbMarque from voiture, marque where marque.id = voiture.idmarque group by idMarque";
        $lesLignes = $db->fetchAll($query);
        $this->view->lesLignes = $lesLignes;
    }

    public function lister2Action() {
        $db = Zend_Db_Table::getDefaultAdapter();
        $query = "select idMarque,marque, count(*) as nbMarque from voiture, marque where marque.id = voiture.idmarque group by idMarque";
        $lesLignes = $db->fetchAll($query);
        $this->view->lesLignes = $lesLignes;
        
       
        
        
    }

}

?>