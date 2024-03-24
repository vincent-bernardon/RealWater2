<?php
if(isset($_SESSION['panier'])){
    //Affichage du panier grace a un tableau


$panier = $_SESSION['panier'];
$prixtotal = 0;


    echo"
    <table>
        <thead>
            <tr>
                <th colspan='5'>Votre panier</th>
            </tr>
        </thead>
        <tbody>";
    foreach ($panier as $key => $value) {
        $bouteille = ModelBouteille::getBouteilleByID($key);



    echo"
            <tr>
                   <th>".$bouteille->getID()."</th>
                <td>Quantité : ".$value."</td>
                <td>Saveure : ".$bouteille->getSaveur()."</td>
                <td>Prix unitaire : ".$bouteille->getPrix()."</td>
                <td>Prix : ".$bouteille->getPrix()*$value."</td>
                <td>
                    <form method='get' action='index.php'>
                        <input type='hidden' name='action' value='retirerDuPanier'/>
                        <input type='hidden' name='controller' value='bouteille'/>
                        <input type='hidden' name='idProduit' value='".$bouteille->getID()."'/>
                        
                        <input type='submit' value='Retirer du panier'/>
                    </form>
                </td>
            </tr>
        
                <!-- idProduit | qteProduit | nomProduit | prixProduit | prixTotal -->
    
    
    
    ";
    $prixtotal = $prixtotal+($bouteille->getprix()*$value);
    }
    echo"
    <th colspan='4'>Prix total :</th>
    <td>".$prixtotal."</td>
    </tbody></table>";
}else{
    echo"Vous n'avez aucun article dans votre panier";
}

echo"

<style>
tr, th, td{
 border: 1px solid white;
}
</style>
";
