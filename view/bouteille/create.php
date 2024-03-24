
<form method="get" action="index.php">
  <fieldset>
    <legend>Créer un nouveau produit :</legend>
    <input type='hidden' name='controller' value='bouteille'>
    <input type='hidden' name='action' value='created'>
    <p>
      <label for="saveur"> Saveur </label> :
      <input type="text" placeholder="Fanta Citron" name="saveur" id="saveur" required/>
    </p>
    <p>
      <label for="materiel"> Matériel </label> :
      <input type="text" placeholder="Verre" name="materiel" id="materiel" required/>
    </p>
    <p>
      <label for="capacite"> Capacité (en cl) </label> :
      <input type="text" placeholder="33" name="capacite" id="capacite" required/>
    </p>
    <p>
      <label for="prix"> Prix (en €) </label> :
      <input type="text" placeholder="15" name="prix" id="prix" required/>
    </p>
    <p>
      <input type="submit" value="Envoyer"/>
    </p>
  </fieldset>
</form>

