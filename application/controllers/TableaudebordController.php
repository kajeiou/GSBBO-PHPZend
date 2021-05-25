<?php

class TableaudebordController extends Zend_Controller_Action {

    public function indexAction() {
        $db = Zend_Db_Table::getDefaultAdapter(); // base gsb
        $query = "select idVisiteur, mois, count(*) as nbFiches, sum(montantValide) as total
                  from ficheFrais
                  group by idVisiteur, mois
                  order by idVisiteur, mois";
        $lesStats = $db->fetchAll($query);
        $this->view->lesStats=$lesStats;
    }
    public function init() {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            $this->_helper->redirector->gotoUrl('auth/login');
        }
    }
}
    