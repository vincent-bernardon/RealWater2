<?php
foreach ($tab_b as $b) {
        echo '<p> Produit ' . $b->getID()
        . '<li> Saveur : ' . $b->getSaveur() . '</li>'
        . '<li> Capacité : ' . $b->getCapacite() . '</li>'
        . '<li> Matériel : ' . $b->getMateriel() . '</li>'
        . '<li> Prix : ' . $b->getPrix() . '</li>'
        . '<li><a href="index.php?controller=bouteille&action=delete&idProduit=' . rawurlencode($b->getID()) .'"> Supprimer </a></li>'
        . '<li><a href="index.php?controller=bouteille&action=update&idProduit=' . rawurlencode($b->getID()) .'"> Modifier </a></li></p>';
}
?>
