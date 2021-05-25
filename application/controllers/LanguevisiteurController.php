<?php

class LanguevisiteurController extends Zend_Controller_Action {

    public function indexAction() {
       // $lesLanguesVisiteurs = new Application_Model_DbTable_Languevisiteur();
        
        //$this->view->lesLanguesVisiteurs=$lesLanguesVisiteurs->fetchAll();

       $lesVilles = new Application_Model_DbTable_Languevisiteur();
//        $this->view->lesVilles = $lesVilles->fetchAll();
        $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_DbTableSelect($lesVilles->select()));
        $paginator->setItemCountPerPage(5);
        $currentPage = isset($_GET['page']) ? (int) htmlentities($_GET['page']) : 1;
        $paginator->setCurrentPageNumber($currentPage);
        $this->view->lesLanguesVisiteurs = $paginator;
        //$this->view->$lesLanguesVisiteurs = $paginateur;
    }

    public function init() {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            $this->_helper->redirector->gotoUrl('auth/login');
        }
    }

}

?>