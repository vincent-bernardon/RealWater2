<form method="get" action="index.php">
    <fieldset>
        <legend> Modifier : </legend>
        <input type='hidden' name='controller' value='bouteille'>
        <input type='hidden' name='action' value='updated'>
        <p>
            <label for="idProduit"> ID Produit </label> :
            <input type="text" value="<?php echo $b->getID(); ?>" name="idProduit" id="idProduit" readonly />
        </p>
        <p>
            <label for="saveur"> Saveur </label> :
            <input type="text" value="<?php echo $b->getSaveur(); ?>" name="saveur" id="saveur" />
        </p>
        <p>
            <label for="materiel"> Matériel </label> :
            <input type="text" value="<?php echo $b->getMateriel(); ?>" name="materiel" id="materiel" />
        </p>
        <p>
            <label for="capacite"> Capacité (en cl) </label> :
            <input type="text" value="<?php echo $b->getCapacite(); ?>" name="capacite" id="capacite" />
        </p>
        <p>
            <label for="prix"> Prix (en €) </label> :
            <input type="text"value="<?php echo $b->getPrix(); ?>" name="prix" id="prix" />
        </p>
        <p>
            <input type="submit" value="Envoyer"/>
        </p>
    </fieldset>
</form>


