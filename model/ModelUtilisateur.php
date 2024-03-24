<?php

require_once File::build_path(array("model","Model.php"));

class ModelUtilisateur
{
    private $idUtilisateur;
    private $nom;
    private $prenom;
    private $mdp;
    private $pseudo;
    private $administrateur; //boolean
    private $email;


    public function __construct($nom = NULL, $prenom = NULL, $mdp = NULL, $pseudo = NULL, $email = NULL){
        if (!is_null($nom) && !is_null($prenom) && !is_null($mdp) && !is_null($pseudo) && !is_null($email)) {
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->mdp = $mdp;
            $this->pseudo = $pseudo;
            $this->email = $email;
            $this->administrateur = false;
        }
    }

    //les getters et setters
    public function setAdministrateur(){
        $this->administrateur = true;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getMdp()
    {
        return $this->mdp;
    }

    public function getPseudo(){
        return $this -> pseudo;
    }

    public function getAdmin(){
        return $this->administrateur;
    }

    public function getEmail(){
        return $this->email;
    }

    //affichage de tout les elements de la table
    public static function getAllCompte(){
        try {
            $pdo = Model::getPDO();
            $rep = $pdo->query('SELECT * FROM p_utilisateur');
            $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
            $tab_utilisateur = $rep->fetchAll();
        }catch(PDOException $a){
            if(Conf::getDebug()){
                echo $a->getMessage();
            }else{
                echo "Une erreur est survenue";
            }
        }
        return $tab_utilisateur;
    }

    //affichage d'un compte via un pseudo
    public static function getCompteByIdentification($value){
        try {
            $sql = "SELECT * from p_utilisateur WHERE pseudo=:ps_tag OR email=:ps_tag";
            $req_prep = Model::getPDO()->prepare($sql);

            $values = array(
                "ps_tag" => $value,
            );

            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
            $tab_utilisateur = $req_prep->fetchAll();

            if (empty($tab_utilisateur))
                return false;
            return $tab_utilisateur[0];
        }catch(PDOException $e){
            if(Conf::getDebug()) echo $e->getMessage();
            else echo "Une erreur est survenue.";
        }
    }

    //insertion dans la table
    public static function save($nom, $prenom, $mdp, $pseudo, $email){
        try {
            $sql = "INSERT INTO p_utilisateur (nom, prenom, mdp, pseudo, email) VALUES ( :nom, :prenom, :mdp, :pseudo, :email)";

            $values = array(
                "nom" => $nom,
                "prenom" => $prenom,
                "mdp" => $mdp,
                "pseudo" => $pseudo,
                "email" => $email,
            );

            $req_prep = Model::getPDO()->prepare($sql);
            $req_prep->execute($values);
            return true;
        }catch(PDOException $e){
            if(Conf::getDebug()){
                echo $e->getMessage();
            }else{
                echo"Une erreur est survenue";
            }
        }
    }

    //on efface un utilisateur de la table
    public static function deleteByID($idUtilisateur){
        try {
            $sql = "DELETE FROM p_utilisateur WHERE id = :id ";
            $req_prep = Model::getPDO()->prepare($sql);

            $values = array(
                "id" => $idUtilisateur,
            );

            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');

        }catch(PDOException $e){
            if(Conf::getDebug()){
                echo $e->getMessage();
            }else{
                echo "Une erreur est survenue";
            }
        }
    }

    //on vérifie qu'il n'y a pas d'autre utilisateur avec le meme pseudo et mdp
    public static function checkPassword($data){
        try {
            $sql = "SELECT * from p_utilisateur WHERE (pseudo =:pseudo_tag OR email=:pseudo_tag)
                              AND mdp =:mdp_tag";
            $req_prep = Model::getPDO()->prepare($sql);

            $values = array(
                "pseudo_tag" => $data['identifiant'],
                "mdp_tag" => $data['motdp'],
            );

            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
            $tab_utilisateur = $req_prep->fetchAll();

            if (empty($tab_utilisateur)){
                return false;
            }
            return true;
        }catch(PDOException $e){
            if(Conf::getDebug()) echo $e->getMessage();
            else echo "Une erreur est survenue.";
        }
    }

    //on vérifie que l'emain est unique dans la table
    public static function checkMail($email){
        try {
            $sql = "SELECT * from p_utilisateur WHERE email =:email_tag";
            $req_prep = Model::getPDO()->prepare($sql);

            $values = array(
                "email_tag" => $email,
            );

            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
            $tab_utilisateur = $req_prep->fetchAll();

            if (empty($tab_utilisateur)){
                return true;
            }
            return false;
        }catch(PDOException $e){
            if(Conf::getDebug()) echo $e->getMessage();
            else echo "Une erreur est survenue.";
        }
    }

    //on verifie que le pseudo inséré est unique et n'existe pas deja dans la table
    public static function checkPseudo($pseudo){
        try {
            $sql = "SELECT * from p_utilisateur WHERE pseudo =:pseudo_tag ";
            $req_prep = Model::getPDO()->prepare($sql);

            $values = array(
                "pseudo_tag" => $pseudo,
            );

            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
            $tab_utilisateur = $req_prep->fetchAll();

            if (empty($tab_utilisateur))
                return true;
            return false;
        } catch(PDOException $e){
            if(Conf::getDebug()) echo $e->getMessage();
            else echo "Une erreur est survenue.";
        }
    }

    //on modifie une ligne de la table
    public static function update($data){
        try{
            $sql = "UPDATE p_utilisateur SET nom=:nom, prenom=:prenom, mdp=:mdp
                    WHERE pseudo=:pseudo";

            $req_prep = Model::getPDO()->prepare($sql);

            $values = array(
                "nom" => $data['nom'],
                "prenom" => $data['prenom'],
                "mdp" => $data['mdp'],
                "pseudo" => $data['pseudo'],
            );

            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
        } catch(PDOException $e){
            if(Conf::getDebug()){
                echo $e->getMessage();
            }else{
                echo "Une erreur est survenue";
            }
        }
    }

    //fonction pour envoyér un mail de confirmation
    public static function mailConfirm($to, $nom, $prenom, $pseudo){
        $subject = 'Creation de compte sur RealWater';
        $message = 'Monsieur '.$nom.' '.$prenom.'Votre compte a bien ete créé, Votre pseudo : '.$pseudo;
        $header = array(
            'From' => 'realwater@YOPmail.com',
            'Reply-To' => 'realwater@YOPmail.com',
            'X-Mailer' => 'PHP/' . phpversion()
        );

        mail($to,$subject,$message,$header);
    }

}
?>