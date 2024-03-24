<form method="get" action="index.php">
    <fieldset>
        <legend>Modifier :</legend>
        <input type='hidden' name='controller' value='utilisateur'>
        <input type='hidden' name='action' value='updated'>
        <p>
            <label for="pseudo"> Pseudo (invariant)</label> :
            <input type="text" value="<?php echo $u->getPseudo(); ?>" name="pseudo" id="pseudo" readonly/>
        </p>
        <p>
            <label for="mail"> Email (invariant)</label> :
            <input type="text" value="<?php echo $u->getEmail(); ?>" name="mail" id="mail" readonly/>
        </p>
        <p>
            <label for="nom"> Nom </label> :
            <input type="text" value="<?php echo $u->getNom(); ?>" name="nom" id="nom" />
        </p>
        <p>
            <label for="prenom"> Prenom </label> :
            <input type="text" value="<?php echo $u->getPrenom(); ?>" name="prenom" id="prenom" />
        </p>
        <p>
            <label for="mdp">Mot de passe</label> :
            <input type="password" placeholder="New mdp" name="mdp" id="mdp" />
        </p>
        <p>
            <input type="submit" value="Envoyer"/>
        </p>
    </fieldset>
</form>
