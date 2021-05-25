<?php

class Zend_View_Helper_Anciennete extends Zend_View_Helper_Abstract {
    public function anciennete($dateEmbauche) {
        date_default_timezone_set('Europe/Paris');
        $now = date_create(date('Y-m-d'));
        $dateEmbauche=date_create($dateEmbauche);
        $anciennete = date_diff($dateEmbauche,$now);
        return intval($anciennete->format("%R%a")/360).' ans';
    }
    
}


?>