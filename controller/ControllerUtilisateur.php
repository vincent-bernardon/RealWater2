<?php
require_once File::build_path(array("model", "ModelUtilisateur.php"));
require_once File::build_path(array("lib", "Security.php"));

class ControllerUtilisateur
{
    //affiche tout les élements de la table utilisateur
    public static function readAll() {
        $tab_v = ModelUtilisateur::getAllCompte();     //appel au modèle pour gerer la BD
        $controller ='utilisateur';
        $view='list';
        $pagetitle='Liste des utilisateurs';
        require (File::build_path(array('view','view.php')));//"redirige" vers la vue
    }

    //affiche une ligne de la table
    public static function read(){
        if(isset($_GET["pseudo"])) $value = $_GET["pseudo"];
        else if (isset($_POST["pseudo"])) $value = $_POST["pseudo"];
        $v = ModelUtilisateur::getCompteByIdentification($value);

        if($v!=null){
            $controller ='utilisateur';
            $view='detail';
            $pagetitle='Detail '.$v->getIdUtilisateur();
            require (File::build_path(array('view','view.php')));
        }
        else{
            $controller ='erreur';
            $view='erreur';
            $pagetitle='Erreur '.$_GET["idUtilisateur"];
            require(File::build_path(array('view','view.php')));
        }
    }

    //appelle la vue profil.php qui permet l'affichage des élements d'un utilisateur
    public static function profil(){
        $controller ='utilisateur';
        $view='detail';
        $pagetitle='Profil';
        $u = ModelUtilisateur::getCompteByIdentification($_SESSION['pseudo']);
        require_once (File::build_path(array('view','view.php')));
    }

    //appelle la vue update.php pour modifier un profil
    public static function update(){
        $controller ='utilisateur';
        $view='update';
        $pagetitle='Modifier le profil';
        $u = ModelUtilisateur::getCompteByIdentification($_SESSION['pseudo']);
        require_once (File::build_path(array('view','view.php')));
    }

    //met à jour le profil avec les modifications apportées
    public static function updated(){
        $data['pseudo'] = $_GET['pseudo'];
        $data['nom'] = $_GET['nom'];
        $data['prenom'] = $_GET['prenom'];
        $data['mdp'] = Security::hacher($_GET['mdp']);

        ModelUtilisateur::update($data);
        $controller ='utilisateur';
        $view='updated';
        $pagetitle='Profil modifié';
        $u = ModelUtilisateur::getCompteByIdentification($_SESSION['pseudo']);
        require_once (File::build_path(array('view','view.php')));
    }

    //appelle la vue create.php pour inserer un nouver utilisateur dans la table
    public static function create(){
        $controller ='utilisateur';
        $view='create';
        $pagetitle='Creer un compte';
        require_once (File::build_path(array('view','view.php')));
    }

    //inser les données du nouvel utilisateur dans la table
    public static function created(){
        $mdpsecurise = Security::hacher($_GET['mdp']);


        if(ModelUtilisateur::checkMail($_GET['email'])){
            if(ModelUtilisateur::checkPseudo($_GET['pseudo'])){
                if (ModelUtilisateur::save($_GET['nom'],$_GET['prenom'],$mdpsecurise, $_GET['pseudo'], $_GET['email'])){

                    ModelUtilisateur::MailConfirm($_GET['email'],$_GET['nom'],$_GET['prenom'],$_GET['pseudo']);

                    $controller ='utilisateur';
                    $view='created';
                    $pagetitle='Compte créé';
                    require_once File::build_path(array('view','view.php'));
                }
            }
        }
        $controller ='erreur';
        $view='erreur';
        $pagetitle='ALED WSH';
        require_once File::build_path(array('view','view.php'));

    }

    //efface un utilisateur
    public static function delete(){
        if(ModelUtilisateur::deleteByID($_GET["idUtilisateur"])){
            $controller ='utilisateur';
            $view='deleted';
            $pagetitle='Compte suprimmée';
            $tab_u = ModelUtilisateur::getAllCompte();
            require_once File::build_path(array('view','view.php'));
        }else{
            $controller ='erreur';
            $view='erreur';
            $pagetitle='ALED WSH';
            require_once File::build_path(array('view','view.php'));
        }
    }

    //appelle la vue connextion.php pour ce connecter
    public static function connect(){
        $controller ='utilisateur';
        $view='connexion';
        $pagetitle='Connexion';
        require_once File::build_path(array('view','view.php'));
    }

    //vérifie si les données sont correcte et appelle la vue connected.php
    public static function connected(){
        $dataUse = array(
            'motdp' => $_POST['mdp'],
            'identifiant' => $_POST['identifiant']);

        $mdpsecurise = Security::hacher($_POST['mdp']);
        $dataUse2 = array(
            'motdp' => $mdpsecurise,
            'identifiant' => $_POST['identifiant']);

        if(ModelUtilisateur::checkPassword($dataUse2)){
            $u = ModelUtilisateur::getCompteByIdentification($dataUse2['identifiant']);
            $_SESSION['connect'] = 1;
            $_SESSION['pseudo'] = $u->getPseudo();
            if($u->getAdmin()){
                $_SESSION['admin'] = 1;
            }
            $controller ='utilisateur';
            $view='detail';
            $pagetitle='Profil';
            require_once File::build_path(array('view','view.php'));

        }else{
            $controller = 'utilisateur';
            $view='connexion';
            $pagetitle='Connexion';
            require_once File::build_path(array('view','view.php'));
        }

    }

    //appelle la vue erreur.php
    public static function error()
    {
        $controller = 'erreur';
        $view = 'erreur';
        $pagetitle='ALEDWSH';
        require_once File::build_path(array('view','view.php'));
    }

    //appelle la vue panier.php
    public static function panier(){
        $controller ='utilisateur';
        $view ='panier';
        $pagetitle ='Votre panier';
        //trouver comment avoir tout les produits de la session qui devrait avoir id + nb de chaque produit.


        require_once File::build_path(array('view','view.php'));
    }

    //detuit la session en cours et renvoie vers la page d'acceuil
    public static function deconnect(){
        session_unset();
        session_destroy();
        setcookie($_COOKIE['PHPSESSID'],"",-1);
        $controller = "bouteille";
        $view = "acceuil";
        $pagetitle = "Page d'acceuil";
        ControllerBouteille::acceuil();
    }
}