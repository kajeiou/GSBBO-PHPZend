<h1>Liste des Utilisateurs</h1>
    
<?php

echo '<table border="1">';
foreach($this->lesVisiteurs as $Visiteur) {
    echo '<tr>';
    echo '<td>' . $Visiteur['id']. '</td>';
    echo '<td>' . $Visiteur['nom']. '</td>';
    echo '<td>' . $Visiteur['prenom']. '</td>';
}

echo '</table>';

$pages = $this->lesVisiteurs->getPages();


if($pages->current !== $pages->first) {
    echo "<a href=?page=$pages->first> <<</a>&nbsp;";
}

if($pages->current > $pages->first)
{
    echo "<a href=?page=$pages->previous> <</a>&nbsp;";
}

foreach ($pages->pagesInRange as $page) {
    echo "<a href=?page=$page>$page</a>&nbsp;";
}
if($pages->current < $pages->last) {
    echo "<a href=?page=$pages->next> ></a>&nbsp;";
}

if($pages->current !== $pages->last) {
    echo "<a href=?page=$pages->last> >></a>&nbsp;";
}

?>