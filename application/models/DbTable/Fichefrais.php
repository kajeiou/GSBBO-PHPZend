<?php

class Application_Model_DbTable_Fichefrais extends Zend_Db_Table_Abstract {

    protected $_name = 'fichefrais';
    protected $_rowClass='Application_Model_DbTable_FichefraisRow';
    
    protected $_referenceMap=array(
        'FKvisiteur'=>array(
            'columns'=>'idVisiteur',
            'refTableClass'=>'Application_Model_DbTable_Visiteur',
            'refColumns'=>'id'
        )
    );

}

?>