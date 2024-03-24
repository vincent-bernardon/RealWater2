<header>
<link rel="stylesheet" type="text/css" href="css/contact.css">
</header>
<body class="site">

    <h1>Feuille de contact</h1>

    <main class="site-content">
      <form action="contact" method="get">
              
        <p>

         <fieldset>
          <legend>Informations personnelles</legend>

            <div>
              <label for="firstname"><span class="star">*</span>Prénom</label>
                <input id="firstname" name="firstname" type="text" required placeholder="Vivien">
            </div>

            <div>
              <label for="surname"><span class="star">*</span>Nom</label>
                <input type="text" id="surname" name="suname" required placeholder="Chezmoi"> 
            </div>

            <div>
              <label><span class="star">*</span>Sexe :</label>
                <input type="radio" id="male" name="gender" value="male" required>
              <label for="male">Homme</label>
                <input type="radio" id="female" name="gender" value="female" required>
              <label for="female">Femme</label>
           </div>

           <div>
              <label for="birthday"><span class="star">*</span>Date de naissance:</label>
                <input type="date" id="birthday" name="birthday" required>
            </div>

            <div>
              <label for="email"><span class="star">*</span>Adresse mail</label>
                <input type="email" id="email" name="email" required placeholder="yourmail@domain.com"> 
            </div>

            <div>
              <label for="postal">Code postal</label>
                <input type="text" id="postal" name="postal" placeholder="11100" pattern="[0-9]{5}">
            </div>

            <div>
              <label for="country">Pays</label>
                <select name="country" id="country">
                  <option value="U.S.A">U.S.A</option>
                  <option value="Fr" selected>France</option>
                  <option value="Ch">Chine</option>
                  <option value="Viêt">Viêt Nam</option>
                  <option value='Fr_M'>Monaco</option>
                  <option value='Fr_B'>Belgique</option>
                  <option value='Fr_L'>Luxembourg</option>
                  <option value='Ca'>Canada</option>
                </select>
            </div>

         </fieldset>

         <fieldset>
           <legend>Enquête</legend>

            <div>
              <label for="cncv">Comment nous connaissez vous ?</label>
                <select name="cncv" id="cncv">
                  <option value="Twitter">Twitter</option>
                  <option value="TikTok">TikTok</option>
                  <option value="Bible">La Bible</option>
                  <option value="Discord">Discord</option>
                  <option value="Random">Random</option>
                </select>
            </div>

            <div>
              <label for="dr">Date à laquelle on peut vous recontacter</label>
                <input type="date" id="dr" name="dr">
            </div>

            <div>
              <label for="comme_tu_veux">Pour la faq :</label>
                <div>
                  <textarea name="comme_tu_veux" id="comme_tu_veux" rows="5" cols="33" placeholder="Défoule-toi dans ce champ de texte"></textarea>
                </div>
            </div>

         </fieldset>
         <input type="submit" value="Envoyer" class="button">
         
      </form>
    </main>

  </body>