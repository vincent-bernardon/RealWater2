<?php
require_once File::build_path(array("model","Model.php"));

class ModelBouteille {
	
	private $idProduit;
	private $capacite;
	private $materiel;
	private $saveur;
	private $prix;

	public function __construct($c = NULL, $m = NULL, $s = NULL, $p = NULL) {
		if(!is_null($c) && !is_null($m) && !is_null($s) && !is_null($p)) {
			$this->capacite = $c;
			$this->materiel = $m;
			$this->saveur = $s;
			$this->prix = $p;
		}
	}

	// les getters
	public function getID(){
		return $this->idProduit;
	}

	public function getCapacite(){
		return $this->capacite;
	}

	public function getMateriel(){
		return $this->materiel;
	}

	public function getSaveur(){
		return $this->saveur;
	}

	public function getPrix(){
		return $this->prix;
	}

    //les setters
    public function setCapacite($capacite){
        $this->capacite = $capacite;
    }

    public function setMateriel($materiel){
        $this->materiel = $materiel;
    }

    public function setSaveur($saveur){
        $this->saveur = $saveur;
    }

    public function setPrix($prix){
        $this->prix = $prix;
    }

    //on récupère tout les éléments de la table des produits
    public static function getAllBouteille(){
	    try {
            $pdo = Model::getPDO();
            $rep = $pdo->query('SELECT * FROM p_produit');
            $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelBouteille');
            $tab_bouteille = $rep->fetchAll();
        }catch(PDOException $a){
	        if(Conf::getDebug()){
	            echo $a->getMessage();
            }else{
	            echo "Une erreur est survenue";
            }
        }
        return $tab_bouteille;
    }

    //on récupère une seule ligne de la table
    public static function getBouteilleByID($id){
	    try {
            $sql = "SELECT * from p_produit WHERE idProduit=:nom_tag";
            $req_prep = Model::getPDO()->prepare($sql);

            $values = array(
                "nom_tag" => $id,
            );

            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelBouteille');
            $tab_bouteille = $req_prep->fetchAll();

            if (empty($tab_bouteille))
                return false;
            return $tab_bouteille[0];
        }catch(PDOException $e){
            if(Conf::getDebug()) echo $e->getMessage();
            else echo "Une erreur est survenue.";
        }
    }

    //on ajoute une nouvelle ligne dans la table
    public static function save($ca, $m, $s, $p){
	    try {
            $sql = "INSERT INTO p_produit (capacite, materiel, saveur, prix) VALUES (:c, :m, :s, :p)";

            $values = array(
                "c" => $ca,
                "m" => $m,
                "s" => $s,
                "p" => $p,
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

    //on efface une ligne de la table
    public static function deleteByID($id){
        try {
            $sql = "DELETE FROM p_produit WHERE idProduit =:id ";
            $req_prep = Model::getPDO()->prepare($sql);

            $values = array(
                "id" => $id,
            );

            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelBouteille');
            return true;

        }catch(PDOException $e){
            if(Conf::getDebug()){
                echo $e->getMessage();
            }else{
                echo "Une erreur est survenue";
            }
        }
	}

    //on ajoute un élément dans le panier
    public static function ajouterAuPanier($id,$qte){
        $v = self::getBouteilleByID($id);



        //ajouter au panier

        if(isset($_SESSION['panier'])) {
            $panier = $_SESSION['panier'];
        }else{
            $_SESSION['panier'] = array();
            $panier = $_SESSION['panier'];
        }



        if(isset($panier[$id])){
            $panier[$id]=$panier[$id]+$qte;
            $_SESSION['panier'] = $panier;
        }else{
            $panier[$id]=$qte;
            $_SESSION['panier'] = $panier;
        }

        if(isset($_SESSION['panier'])){
            return true;
        }else{
            return false;
        }
    }

    //on met à jour une ligne de la table
    public static function update($data){
        try{
            $sql = "UPDATE p_produit SET capacite=:c, materiel=:m, saveur=:s, prix=:p 
                    WHERE idProduit=:idProduit";

            $req_prep = Model::getPDO()->prepare($sql);

            $values = array(
                "c" => $data['capacite'],
                "m" => $data['materiel'],
                "s" => $data['saveur'],
                "p" => $data['prix'],
                "idProduit" => $data['idProduit'],
            );

            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelBouteille');
        } catch(PDOException $e){
            if(Conf::getDebug()){
                echo $e->getMessage();
            }else{
                echo "Une erreur est survenue";
            }
        }
    }

}
?>