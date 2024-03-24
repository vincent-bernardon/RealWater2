<body>
<?php
echo '<p> Utilisateur:
      <li>Pseudo = '. $u->getPseudo() . '</li>' .
     '<li> Nom = '. $u->getNom() . '</li>' .
     '<li> Prenom = '. $u->getPrenom() . '</li>' .
     '<li> Email = '. $u->getEmail() . '</li>';
if($u->getAdmin()){
    echo '<li> Statut = Admin</li>';
} else {
    echo '<li> Statut = Client</li>';
}
echo '<li><a href="index.php?controller=utilisateur&action=update&pseudo=' . rawurlencode($u->getPseudo()) .'"> Modifier </a></li></p>';

?>
</body>