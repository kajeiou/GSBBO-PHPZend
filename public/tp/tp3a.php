<?php


require_once'../autoloader.php';

$lesSuperHeros = array('Batman','Iron-man','Spiderman','Venom','Volverine','BlackPower','HellBoy','Biloute');
$view = new Zend_View();

$view->lesSuperHeros=$lesSuperHeros;
$view->addScriptPath('.');
echo $view->render('tp3avue.php');
?>