<?php

class ProjetController extends Zend_Controller_Action {

    public function infoAction() {

        $this->view->phpVersion = phpversion();
        $this->view->auteur = "Nabil";
    }

}

?>