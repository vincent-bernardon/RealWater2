<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <title> <?php echo $pagetitle; ?></title>    
  </head>

  <body class="site">
    <header>
    <img src="images/LOGO.png" alt="le logo" class="logo">
    <div class="burger">
      <img src="images/burger.png" alt="burger">
      <div id="menu2">
        <div><a href="index.php?controller=bouteille&action=acceuil">Acceuil</a></div>
        <div><a href="index.php?controller=OldHTML&action=printEquipe">Equipe</a></div>
        <div><a href="index.php?controller=OldHTML&action=printPresse">Presse</a></div>
        <div><a href="index.php?controller=OldHTML&action=printContact">Contact</a></div>
        <div><a href="index.php?controller=OldHTML&action=printFAQ">FAQ</a></div>
          <div><a class="dropdown-arrow" href="index.php?controller=OldHTML&action=printRejoindre">Rejoindre</a>
            <ul class='sub-menus'>
              <li><a href='index.php?controller=OldHTML&action=printMetier1'>Puiseur</a></li>
              <li><a href='index.php?controller=OldHTML&action=printMetier2'>Mise en bouteilleiste</a></li>
              <li><a href='index.php?controller=OldHTML&action=printMetier3'>Forgeur de bouteille</a></li>
            </ul>
          </div>
          <?php
          if(!isset($_SESSION['connect'])){
              echo "
                <div><a href=\"index.php?controller=utilisateur&action=create\"> Inscription</a></div>
                <div><a href=\"index.php?controller=utilisateur&action=connect\"> Connexion </a></div>
                 ";
          }else{
              echo"<div><a href=\"index.php?controller=utilisateur&action=deconnect\">Deconnexion</a></div>
                   <div><a href=\"index.php?controller=utilisateur&action=profil\"> Profil </a></div>";
              if($_SESSION['admin'] == 1){
                  echo "<div><a href=\"index.php?controller=bouteille&action=create\"> Création </a></div>
                        <div><a href=\"index.php?controller=bouteille&action=readAll\"> Bouteilles </a></div>";
              }
          }
          ?>
          <div><a href="index.php?controller=utilisateur&action=panier"> Panier </a></div>
        </div>
      </div>
      <nav id='menu'>
        <input type='checkbox' id='responsive-menu' onclick='updatemenu()'><label></label>
        <ul>
          <li><a href='index.php?controller=bouteille&action=acceuil'>Acceuil</a></li>
          <li><a href='index.php?controller=OldHTML&action=printEquipe'>Equipe</a></li>
          <li><a href='index.php?controller=OldHTML&action=printPresse'>Presse</a></li>
          <li><a href='index.php?controller=OldHTML&action=printContact'>Contact</a></li>
          <li><a href='index.php?controller=OldHTML&action=printFAQ'>FAQ</a></li>
          <li><a class='dropdown-arrow' href='index.php?controller=OldHTML&action=printRejoindre'>Rejoindre</a>
            <ul class='sub-menus'>
              <li><a href='index.php?controller=OldHTML&action=printMetier1'>Puiseur</a></li>
              <li><a href='index.php?controller=OldHTML&action=printMetier2'>Mise en bouteilleiste</a></li>
              <li><a href='index.php?controller=OldHTML&action=printMetier3'>Forgeur de bouteille</a></li>
            </ul>
          </li>
            <?php
            if(!isset($_SESSION['connect'])){
                echo"<li><a href=\"index.php?controller=utilisateur&action=create\"> Inscription </a></li>
                     <li><a href=\"index.php?controller=utilisateur&action=connect\"> Connexion </a></li>
               ";
            }else{
                echo "<li><a href=\"index.php?controller=utilisateur&action=deconnect\">Deconnexion</a></li>
                      <li><a href=\"index.php?controller=utilisateur&action=profil\"> Profil </a></li>";
                if($_SESSION['admin'] == 1){
                    echo "<li><a href=\"index.php?controller=bouteille&action=create\"> Création </a></li>";
                    echo "<li><a href=\"index.php?controller=bouteille&action=readAll\"> Bouteilles </a></li>";
                }
            }
            ?>
            <li><a href="index.php?controller=utilisateur&action=panier"> Panier </a></li>
        </ul>
      </nav>
      <img src="images/backgroundCopie.jpg" id="background" alt="arrière-plan de bulles">
    </header>
    <?php
      $filepath = File::build_path(array("view", $controller, "$view.php"));
      require $filepath;
    ?>

  <footer class="site-footer">
    <div class="footer">        
      <div class="footer-social">     
      <p>Suivez-nous sur les réseaux sociaux !</p>     
      <img src="images/Twitter.png" alt="logo-twitter" class="reseaux">
      <img src="images/facebook.png" alt="logo-twitter" class="reseaux">
      <img src="images/instagram.png" alt="logo-twitter" class="reseaux">
      </div>
    </div>
  </footer>
  </body>
</html>