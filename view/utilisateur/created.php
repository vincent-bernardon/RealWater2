
    <?php
        if($_GET['mdp']==$_GET['vmdp']){
            echo "<p> Votre compte à été crée! </p>";
        }else{
            require_once File::build_path(array("erreur","erreur.php"));
        }
    ?>

