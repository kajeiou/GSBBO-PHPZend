<?php

class FicheFraisController extends Zend_Controller_Action {

    public function indexAction() {
        $lesFichesFrais = new Application_Model_DbTable_FicheFrais();
        //$this->view->lesFichesFrais = $lesFichesFrais->fetchAll();
        $paginateur = new Zend_Paginator(new Zend_Paginator_Adapter_DbTableSelect($lesFichesFrais->select()));
        $paginateur->setItemCountPerPage(20);

        $currentPage = isset($_GET['page']) ? (int) htmlentities($_GET['page']) : 1;

        $paginateur->setCurrentPageNumber($currentPage);
        $this->view->lesFichesFrais = $paginateur;
    }
    public function init() {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            $this->_helper->redirector->gotoUrl('auth/login');
        }
    }
    public function exportercsvAction(){
        //ATTETNTION: il faut désactiver le rendu de la vue
        $this->_helper->viewRenderer->setNoRender(true);
        $lesFicheFrais = new Application_Model_DbTable_Fichefrais();
        $FichesFrais = $lesFicheFrais->fetchAll()->toArray();
        
        $output = fopen("php://output", 'w');
        header("Content-Type:application/csv");
        header("Content-Disposition:attachment;filename=fichesfrais.txt");
        $entete = array('idVisiteur', 'mois', 'NbJustificatifs', 'MontantValide', 'dateModif', 'IdEtat');
        fputcsv($output, $entete, ':', '"');
        foreach ($FichesFrais as $uneFicheFrais){
            fputcsv($output, $uneFicheFrais, ':', '"');
        }
        fclose($output);
    }

}
