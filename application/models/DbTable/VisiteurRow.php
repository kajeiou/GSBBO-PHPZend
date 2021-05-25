<?php

class Application_Model_DbTable_VisiteurRow extends Zend_Db_Table_Row_Abstract {
    
    public function getLanguesParlees() {
        $lesLanguesParlees = $this->findDependentRowset('Application_Model_DbTable_Languevisiteur','FKvisiteur');
        return $lesLanguesParlees;
    }
    
    public function getNbLanguesParlees() {
        $lesLanguesParlees = $this->findDependentRowset('Application_Model_DbTable_Languevisiteur','FKvisiteur');
        return count($lesLanguesParlees);
    }
}
?>