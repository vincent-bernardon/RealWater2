
<form method="post" action="index.php">
  <fieldset>
    <legend>Connexion :</legend>

    <p>
        <label for="identifiant"> Identifiant </label> :
        <input type="text" value="<?php if(isset($dataUse)){echo($dataUse['identifiant']);} ?>" placeholder="Pseudo ou email" name="identifiant" id="identifiant" required/>
    </p>
    <p>
      <label for="mdp"> Mot de passe </label> :
      <input type="password" value="<?php if(isset($dataUse)){echo($dataUse['motdp']);} ?>" placeholder="mdpTest" name="mdp" id="mdp" required/>
    </p>
    <p>
    <input type="submit" value="Envoyer"/>
    <input type='hidden' name='action' value='connected'>
    <input type='hidden' name='controller' value='utilisateur'>
    </p>
  </fieldset>
</form>
