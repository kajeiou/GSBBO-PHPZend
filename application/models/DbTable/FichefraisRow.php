<?php

class Application_Model_DbTable_FichefraisRow extends Zend_Db_Table_Row_Abstract{
    
    public function getVisiteur(){
        $leVisiteur= $this->findParentRow('Application_Model_DbTable_Visiteur', 'FKvisiteur');
        return $leVisiteur;
    }
    
    
}
?>