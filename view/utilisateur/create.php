
<form method="get" action="index.php">
  <fieldset>
    <legend>Inscription :</legend>
    <input type='hidden' name='controller' value='utilisateur'>
    <input type='hidden' name='action' value='created'>
    <p>
      <label for="nom_id"> Nom </label> :
      <input type="text" placeholder="Terrieur" name="nom" id="nom_id" required/>
    </p>
    <p>
      <label for="prenom_id"> Prenom </label> :
      <input type="text" placeholder="Alain" name="prenom" id="prenom_id" required/>
    </p>
      <p>
          <label for="email_id"> Email </label> :
          <input type="email" placeholder="abc@123.com" name="email" id="email_id" required/>
      </p>
    <p>
      <label for="pseudo_id"> Pseudo </label> :
      <input type="text" placeholder="Pseudo" name="pseudo" id="pseudo_id" required/>
    </p>
    <p>
      <label for="mdp_id">Mot de passe</label> :
      <input type="password" placeholder="mdpTest" name="mdp" id="mdp_id" required/>
    </p>
    <p>
      <label for="vmdp_id">Verification mot de passe</label> :
      <input type="password" placeholder="vmdpTest" name="vmdp" id="vmdp_id" required/>
    </p>
    <p>
      <input type="submit" value="Envoyer"/>
    </p>
  </fieldset>
</form>

