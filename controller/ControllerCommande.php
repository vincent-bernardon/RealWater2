<?php
require_once File::build_path(array("model", "ModelCommande.php"));

class ControllerCommande
{
    public static function readAll(){
        $tab_v = ModelCommande::getAllCommandes();     //appel au modèle pour gerer la BD
        $controller ='commande';
        $view='acceuil';
        $pagetitle='Liste des Commandes';
        require (File::build_path(array('view','view.php')));//"redirige" vers la vue

    }

    public static function read(){
        if(isset($_GET["id"])) $id = $_GET["id"];
        elseif (isset($_POST["id"])) $id = $_POST["id"];
        $v = ModelCommande::getCommandeByUtilisateur($id);

        if($v!=null){
            $controller ='commande';
            $view='detail';
            $pagetitle='Detail commande : '.$v->getId();
            require (File::build_path(array('view','view.php')));
        }
        else{
            $controller ='erreur';
            $view='erreur';
            $pagetitle='Erreur '.$_GET["id"];
            require(File::build_path(array('view','view.php')));
        }
    }

    public static function create(){
        $controller ='commande';
        $view='create';
        $pagetitle='Creer une Commande';
        require_once (File::build_path(array('view','view.php')));
    }

    public static function created(){
        if(ModelCommande::save($_GET['idutilisateur'],$_GET['prix'])){
            $controller ='commande';
            $view='created';
            $pagetitle='Commande créée';
            $tab_v = ModelUtilisateur::getAllCompte();
            require_once File::build_path(array('view','view.php'));
        }
        else{
            $controller ='erreur';
            $view='erreur';
            $pagetitle='ALED WSH';
            require_once File::build_path(array('view','view.php'));
        }
    }

    public static function delete(){
        if(ModelCommande::deleteByID($_GET["id"])){
            $controller ='commande';
            $view='deleted';
            $pagetitle='Commande suprimmée';
            $tab_v = ModelCommande::getAllCommandes();
            require_once File::build_path(array('view','view.php'));
        }else{
            $controller ='erreur';
            $view='error';
            $pagetitle='ALED WSH';
            require_once File::build_path(array('view','view.php'));
        }

    }

    public static function error()
    {
        $controller = 'erreur';
        $view = 'erreur';
        $pagetitle='ALEDWSH';
        require_once File::build_path(array('view','view.php'));
    }
}