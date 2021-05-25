<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    public function _initViewHelpers() {
        $this->bootstrap('layout');
        $layout = $this->getResource('Layout');
        $view = $layout->getView();
        $navContainerConfig = new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation.xml', 'nav');
        $navContainer = new Zend_Navigation($navContainerConfig);
        $view->navigation($navContainer);
    }

}
