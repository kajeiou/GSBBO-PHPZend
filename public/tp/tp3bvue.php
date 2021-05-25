<h1>Liste de tous les heros avec pagination</h3>
<?php 
echo '<table border="1">';

foreach($this->lesSuperHeros as $unSuperHero) {
    echo '<tr><td>'.$unSuperHero.'</td></tr>';
}
echo '</table><br><br><br>';

//Bandeau de navigation
$pages = $this->lesSuperHeros->getPages();


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