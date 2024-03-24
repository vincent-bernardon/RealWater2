
    <?php
    foreach ($tab_u as $u)
        echo '<p> Utilisateur:
             id = '. $u->getidUtilisateur().
            ', Nom = '. $u->getNom() .
            ', Prenom = '. $u->getPrenom() . '.</p>';
    ?>
