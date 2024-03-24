<link rel="stylesheet" type="text/css" href="css/produit.css">
<body class="site">
    <h1>Notre Produit</h1>

    <main class="site-content">
      <img src="images/bouteil.png" alt="la bouteil" class="bouteil">

      <div class="punch">
        <p class='slogan1'> "L'eau classique est révolue, puisqu'elle est composé de deux hydrogènes (H2O), mais maintenant avec RealWater l'eau est composée a 100% d'eau. Cette avancée monumentale propulse inévitablement RealWater en tant que leader mondial de l'eau."</p>

        <?php
        foreach ($tab_v as $v)
            echo '<p> Bouteille Saveur : <a href="index.php?action=read&idProduit='.rawurlencode($v->getID()).'">' . htmlspecialchars($v->getSaveur()).'</a>' . '.</p>';
        ?>

        <p class='slogan2'>Pourquoi rester à l'écart du bonheur ? Achetez RealWater !</p>
      </div>
    </main>
  </body>