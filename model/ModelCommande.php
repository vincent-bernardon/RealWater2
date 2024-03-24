<?php
require_once File::build_path(array("model","Model.php"));

class ModelCommande {

    private $idCommande;
    private $prixTotal;
    private $idUtilisateur;

    public function __construct($idCommande = NULL, $prixTotal = NULL, $idUtilisateur = NULL){
        if(!is_null($idCommande) && !is_null($prixTotal) && !is_null($idUtilisateur)){
            $this->idCommande = $idCommande;
            $this->prixTotal = $prixTotal;
            $this->idUtilisateur = $idUtilisateur;
        }
    }

    //Les getters
    public function getIdCommande(){
        return $this->idCommande;
    }

    public function getPrixTotal(){
        return $this->prixTotal;
    }

    public function getIdUtilisateur(){
        return $this->idUtilisateur;
    }

    //inserer une nouvelle commande dans la table
    public static function save($idUtilisateur, $prix){
        try {
            $sql = "INSERT INTO p_commande (idUtilisateur, prix) VALUES ( :id, :prix)";

            $values = array(
                "id" => $idUtilisateur,
                "prix" => $prix,
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

    //fonction pour récuperer tout les élements de la table commande
    public static function getAllCommandes(){
    try {
        $pdo = Model::getPDO();
        $rep = $pdo->query('SELECT * FROM p_commandes');
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelCommandes');
        $tab_commande = $rep->fetchAll();
    }catch(PDOException $a){
        if(Conf::getDebug()){
            echo $a->getMessage();
        }else{
            echo "Une erreur est survenue";
        }
    }
    return $tab_commande;
    }

    public static function deleteByID($id){
        try {
            $sql = "DELETE FROM p_commande WHERE idCommande =:id ";
            $req_prep = Model::getPDO()->prepare($sql);

            $values = array(
                "id" => $id,
            );

            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelCommande');
            return true;

        }catch(PDOException $e){
            if(Conf::getDebug()){
                echo $e->getMessage();
            }else{
                echo "Une erreur est survenue";
            }
        }
    }

    //on récupère toute les commandes d'un utilisateur
    public static function getCommandeByUtilisateur($id){
        try {
            $pdo = Model::getPDO();
            $rep = $pdo->query('SELECT * FROM p_commandes WHERE idUtilisateur = :id');
            $req_prep = Model::getPDO()->prepare($rep);

            $values = array(
                "id" => $id,
            );

            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelCommande');
            $tab_commande = $req_prep->fetchAll();
        } catch(PDOException $a){
            if(Conf::getDebug()){
                echo $a->getMessage();
            }else{
                echo "Une erreur est survenue";
            }
        }
        return $tab_commande;
    }

}
?>