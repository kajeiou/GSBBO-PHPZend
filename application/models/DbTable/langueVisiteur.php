<?php

class Application_Model_DbTable_Languevisiteur extends Zend_Db_Table_Abstract {

    protected $_name = "languevisiteur";
    
    protected $_rowClass = "Application_Model_DbTable_LanguevisiteurRow";
    protected $_referenceMap = array(
        'FKvisiteur' => array(
            'columns' => 'idVisiteur',
            'refTableClass' => 'Application_Model_DbTable_Visiteur',
            'refColumns' => 'id'
        ),
        'FKlangue' => array(
            'columns' => 'idLangue',
            'refTableClass' => 'Application_Model_DbTable_Langue',
            'refColumns' => 'id'
        )
            )

    ;
}
