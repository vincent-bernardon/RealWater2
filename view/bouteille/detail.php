<?php echo"
<!DOCTYPE html>
<html>
<body>


<p> 
    <ul> 
    <li>" . "Prix : ".$v->getPrix()." </li>
    <li> Capacité : ".$v->getCapacite()." </li>
    <li> wesh la zone" . "</li> 
    </ul>
    <form method='get' action='index.php'>
        <fieldset>
            <p>
                <label for='id_qte'>Quantité a acheter</label> :
                <input id='id_qte' class='quantité' min='1' name='qte' value='1' type='number'>
                <input type='hidden' name='action' value='ajouterAuPanier'>
                <input type='hidden' name='idProduit' value='".$v->getID()."'>
            </p>
            <p>
                <input type='submit' value='Envoyer'/>
            </p>
        </fieldset>
    </form>
</p>


</body>
</html>";
