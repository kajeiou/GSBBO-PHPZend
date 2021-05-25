<?php

class Application_Model_DbTable_Visiteur extends Zend_Db_Table_Abstract {

protected $_name = "visiteur";

protected $_rowClass ="Application_Model_DbTable_VisiteurRow";

//protected $_referenceMap = array(
//    'maMarque'=>array(
//        'columns'=>'idMarque',
//        'refTableClass'=>'Application_Model_DbTable_Marque',
//        'refColumns'=>'id'
//    )
//);

public function ajouterVisiteur ($id, $nom, $prenom,$login, $role) {
    $data = array(
            'id' => utf8_decode($id),
            'nom' => utf8_decode($nom),
            'prenom' => utf8_decode($prenom),
            'login' => utf8_decode($login),
            'role' => utf8_decode($role));
    $this->insert($data);

}
public function obtenirVisiteur($id) {
    $row = $this->fetchRow("id='".$id."'");
    if(!$row) {
        throw new Exception("impossible de trouver l'enregistrement $id");
    }
    return $row->toArray();
}

public function modifierVisiteur($id,$nom,$prenom,$login,$role) {
    $data = array(
        'id' => utf8_encode($id),
        'nom' => utf8_encode($nom),
        'prenom' => utf8_encode($prenom),
        'login' =>utf8_encode($login),
        'role' => utf8_encode($role),
    );
    $this->update($data, "id='". $id . "'");
}
public function obtenirPremierVisiteur() {
    $db = Zend_Db_Table::getDefaultAdapter();
    $query = "select id from visiteur";
    $result = $db->fetchAll($query);
    $id = $result[0]['id'];
    return $id;
}
public function supprimerVisiteur($id) {
    $this->delete("id='" . $id . "'");
}

}
