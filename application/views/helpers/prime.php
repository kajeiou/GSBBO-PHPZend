<?php

class Zend_View_Helper_Prime extends Zend_View_Helper_Abstract {
    public function prime($dateEmbauche) {
        date_default_timezone_set('Europe/Paris');
        $now = date_create(date('Y-m-d'));
        $dateEmbauche=date_create($dateEmbauche);
        $anciennete = date_diff($dateEmbauche,$now);
        $annee = intval($anciennete->format("%R%a")/360);
        
        if($annee<=4) {
            return 0;
        }
        else {
            if($annee<=8) {
                return 2200*0.05;
            }
            else {
                if($annee<=16) {
                    return 2200*0.10;
                }
                else {
                    return 2200*0.15;
                }
            }
        }
        
    }
    
}


?>