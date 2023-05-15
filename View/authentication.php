<section class="authentication-container" id="authentication-container">
  <div class="wrapper">
    <span class="icon-close"><i class="fa fa-times"></i></span>

    <!-- CONNEXION -->
    <div class="form login login-form-container">
      <header id="connexionHeader">Connexion</header>
      <form action="" method="post" id="loginForm">

        <input type="text" name="loginEmail" id="loginEmail" class="box" placeholder="Email">

        <input type="password" name="loginPassword" class="box loginInputs" id="loginPassword" placeholder="Mot de passe">
        <div class="checkbox">
          <input type="checkbox" name="" id="remember-me">
          <label for="remember-me">Se souvenir de moi</label>
        </div>
        <?php if (isset($_SESSION['user']) && $_SESSION['user']->getType() == 4) : ?>
          <a href="admin.php">Admin</a>
        <?php elseif (isset($_SESSION['user'])) : ?>
          <a href="profil.php">profil</a>
        <?php endif ?>

        <?php if (isset($_SESSION['user'])) : ?>
          <button type="submit" name="disconnect" id="decoButton" class="authentication-btn">Déconnexion</button>

        <?php else : ?>
          <button type="submit" id="loginButton" class="authentication-btn">Se Connecter</button>
        <?php endif ?>
        <p>Mot de passe oublié ? <a href="#"> Cliquez-ici</a></p>
        <p>Pas encore de compte? <a href="#"> S'inscrire</a></p>
      </form>
    </div>
    <!-- INSCRIPTION -->
    <div class="form register register-form-container">

      <header>S'inscrire</header>

      <form method="post" class="loginForms" id="registerForm">

        <select name="registerType" id="registerType">
          <option value="1">Particulier</option>
          <option value="2">Entreprise</option>
        </select>

        <label class="registerLabels" id="registerLabelFirstName" for="registerFirstName">Prénom</label>
        <input type="text" name="registerFirstName" class="loginInputs" id="registerFirstName">

        <label class="registerLabels" id="registerLabelLastName" for="registerLastName">Nom</label>
        <input type="text" name="registerLastName" class="loginInputs" id="registerLastName">

        <label class="registerLabels" id="registerLabelCompany" for="registerCompany">Raison Sociale</label>
        <input type="text" name="registerCompany" class="loginInputs" id="registerCompany">

        <label class="registerLabels" for="registerEmail">Email</label>
        <input type="email" name="registerEmail" class="loginInputs" id="registerEmail">

        <label class="registerLabels" for="registerAdress">Adresse</label>
        <input type="text" name="registerAdress" class="loginInputs" id="registerAdress">

        <label class="registerLabels" for="registerZipCode">Code Postal</label>
        <input type="number" name="registerZipCode" class="loginInputs" id="registerZipCode">

        <label class="registerLabels" for="registerCity">Ville</label>
        <input type="text" name="registerCity" class="loginInputs" id="registerCity">

        <label class="registerLabels" for="registerPassword">Mot de Passe</label>
        <input type="password" name="registerPassword" class="loginInputs" id="registerPassword">

        <label class="registerLabels" for="registerConfirmPassword">Confirmez votre mot de passe</label>
        <input type="password" name="registerConfirmPassword" class="loginInputs" id="registerConfirmPassword">

        <button type="submit" id="registerButton" class="authentication-btn">S'inscrire</button>

      </form>
    </div>
  </div>
</section>