<?php
require_once File::build_path(array("model", "ModelBouteille.php"));



class ControllerBouteille
{
    protected static $controller ='bouteille';

    public static function acceuil() { //affichage de la page d'acceuil
        $tab_v = ModelBouteille::getAllBouteille();     //appel au modèle pour gerer la BD
        $view='acceuil';
        $controller ='bouteille';
        $pagetitle='Liste des Bouteilles';
        require (File::build_path(array('view','view.php')));//"redirige" vers la vue
    }

    public static function readAll(){ //on affiche tout ce qui est présenta dans la table
        $tab_b = ModelBouteille::getAllBouteille();     //appel au modèle pour gerer la BD
        $view='liste';
        $controller ='bouteille';
        $pagetitle='Liste des Bouteilles';
        require (File::build_path(array('view','view.php')));
    }

    public static function read(){
        if(isset($_GET["idProduit"])) $idProduit = $_GET["idProduit"];
        elseif (isset($_POST["idProduit"])) $idProduit = $_POST["idProduit"];
        $v = ModelBouteille::getBouteilleByID($idProduit);

        if($v!=false){
            $controller ='bouteille';
            $view='detail';
            $pagetitle='Detail '.$v->getID();
            require (File::build_path(array('view','view.php')));
        }
        else{
            $controller ='erreur';
            $view='erreur';
            $pagetitle='Erreur '.$_GET["id"];
            require(File::build_path(array('view','view.php')));
        }
    }

    public static function update(){ //appel de la vue update.php
        $controller ='bouteille';
        $view='update';
        $pagetitle='Modifier une bouteille';
        $b = ModelBouteille::getBouteilleByID($_GET['idProduit']);
        require_once (File::build_path(array('view','view.php')));
    }

    public static function updated(){ //mise a jour de la table
        $data['idProduit'] = $_GET['idProduit'];
        $data['saveur'] = $_GET['saveur'];
        $data['materiel'] = $_GET['materiel'];
        $data['capacite'] = $_GET['capacite'];
        $data['prix'] = $_GET['prix'];

        ModelBouteille::update($data);
        $controller ='bouteille';
        $view='updated';
        $pagetitle='Bouteille modifée';
        $tab_b = ModelBouteille::getAllBouteille();
        require_once (File::build_path(array('view','view.php')));
    }

    public static function create(){ //appel de la vue create.php
        $controller ='bouteille';
        $view='create';
        $pagetitle='Creer une Bouteille';
        require_once (File::build_path(array('view','view.php')));
    }

    public static function created(){ //insertion dans la table
        if(ModelBouteille::save($_GET['capacite'],$_GET['materiel'],$_GET['saveur'], $_GET['prix'])){
            $controller ='bouteille';
            $view='created';
            $pagetitle='Bouteille créée';
            $tab_b = ModelBouteille::getAllBouteille();
            require_once (File::build_path(array('view','view.php')));
        }
        else{
            $controller ='erreur';
            $view='erreur';
            $pagetitle='ALED WSH';
            require_once File::build_path(array('view','view.php'));
        }
    }

    public static function delete(){ //suppression d'une ligne de la table
        if(ModelBouteille::deleteByID($_GET["idProduit"])){
            $controller ='bouteille';
            $view='deleted';
            $pagetitle='Bouteille suprimmée';
            $tab_b = ModelBouteille::getAllBouteille();
            require_once (File::build_path(array('view','view.php')));
        }else{
            $controller ='erreur';
            $view='erreur';
            $pagetitle='ALED WSH';
            require_once File::build_path(array('view','view.php'));
        }

    }

    public static function readPanier(){ //appel de la vue panier.php
        $controller ='bouteille';
        $view='panier';
        $pagetitle='Votre Panier';
        require_once File::build_path(array('view','view.php'));
    }

    public static function error() //affichage de la page d'erreur
    {
        $controller = 'erreur';
        $view = 'erreur';
        $pagetitle='ALEDWSH';
        require_once File::build_path(array('view','view.php'));
    }

    public static function ajouterAuPanier(){ //fonction pour ajouter au panier

        if(isset($_GET["idProduit"])) $idProduit = $_GET["idProduit"];
        elseif (isset($_POST["idProduit"])) $idProduit = $_POST["idProduit"];

        if(isset($_GET["qte"])) $qte = intval($_GET["qte"]);
        elseif (isset($_POST["qte"])) $qte = intval($_POST["qte"]);

        $v = ModelBouteille::getBouteilleByID($idProduit);

        if(ModelBouteille::ajouterAuPanier($idProduit,$qte)) {
            $controller = 'bouteille';
            $view = 'detail';
            $pagetitle = 'Detail ' . $v->getID();
            require(File::build_path(array('view', 'view.php')));
        }else{
            $controller = 'erreur';
            $view = 'erreur';
            $pagetitle='ALEDWSH';
            require_once File::build_path(array('view','view.php'));
        }

    }

    public static function retirerDuPanier(){//fonction pour retire du panier
        $panier = $_SESSION['panier'];
        $newPanier = array();
        foreach ($panier as $key => $value){
            if ($key != $_GET['idProduit']){
                array_push($newPanier,$key,$value);
            }
        }
        if(sizeof($newPanier)==0){
            unset($_SESSION['panier']);
        }else {
            $_SESSION['panier'] = $newPanier;
        }

        $controller ='utilisateur';
        $view='panier';
        $pagetitle='Detail '.$_GET['idProduit'];
        require (File::build_path(array('view','view.php')));
    }

}