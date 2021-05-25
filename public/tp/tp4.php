<?php

require_once '../autoloader.php';

$db = new Zend_Db_Adapter_Pdo_Mysql(
        array(
            'host'=>'localhost',
            'username' => 'root',
            'password' => 'root',
            'dbname' => 'gsbv2',
        ));

$view = new Zend_View();

$lesVisiteurs = new Zend_Db_Select($db);
$lesVisiteurs->from('utilisateurs');


$paginateur = new Zend_Paginator(new Zend_Paginator_Adapter_DbTableSelect($lesVisiteurs));
$paginateur->setItemCountPerPage(10);

$currentPage= isset($_GET['page']) ? (int) htmlentities($_GET['page']) : 1;

$paginateur->setCurrentPageNumber($currentPage);

$view->lesVisiteurs=$paginateur;
$view->addScriptPath('.');
echo $view->render('tp4vue.php');

?>