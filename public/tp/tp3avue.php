<h1>Liste des super-héro</h1>

<?php 
echo '<table border="1">';

foreach($this->lesSuperHeros as $unSuperHero) {
    echo '<tr><td>'.$unSuperHero.'</td></tr>';
}
echo '</table>';
?>