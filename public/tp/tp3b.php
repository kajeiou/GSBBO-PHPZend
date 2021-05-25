<?php

require_once'../autoloader.php';

$lesSuperHeros = array('Batman','Iron-man','Spiderman','Venom','Volverine','BlackPower','HellBoy','Biloute');
$view = new Zend_View();

$paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($lesSuperHeros));

$paginator->setItemCountPerPage(2);

$currentPage= isset($_GET['page']) ? (int) htmlentities($_GET['page']) : 1;

$paginator->setCurrentPageNumber($currentPage);

$view->lesSuperHeros=$paginator;

$view->addScriptPath('.');

echo $view->render('tp3bvue.php');

?>