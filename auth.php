<?php
session_start();
include("includes/functions.php");
include("config.php");
include("vendor/autoload.php");

pr($_POST);

// ================================
//si le Formulaire est soumis...
// ================================
if (!empty($_POST)){
  // ===========================================================
  //on créer nos variables, tout en enlevant les balises html
  //et les espaces en début et fin de chaine
  // ===========================================================
  $email = trim(strip_tags($_POST['email']));
  $username = trim(strip_tags($_POST['username']));
  $password = trim(strip_tags($_POST['password']));
  $password_confirm = trim(strip_tags($_POST['password_confirm']));
  // ================
  // validation
  // email vide ?
  // ================
  if(empty($email)){
    $error="Veuillez renseigner votre email !";
  }
  // =================
  // email valide ?
  // =================
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $error = "Votre e-mail n'est pas valide !";
  }
  // =====================
  // e-mail trop long ?
  // =====================
  elseif (strlen($email) > 100){
    $error = "Votre e-mail es trop long !";
  }
  // contient uniquement des lettres, des chiffres et des tirets et des underscore
  elseif(!preg_match($usernameRegexp, "$username")){
    echo "Votre pseudo doit correspondre !";

  else {
    // ==================================
    // e-mail déjà présent dans la base ?
    // ==================================
    $sql="SELECT email FROM users WHERE email= :email";
    $sth = $dbh->prepare ($sql);
    // ================================
    //  l'array remplace le bindValue()
    // ================================
    $sth->execute(array(":email" => $email));
    $foundEmail = $sth->fetchColumn();

    if ($foundEmail) {
      $error ="Cet email est déja utilisé";


  }
}
// ============================================
// expression rationnelle pour nos usernames
// ============================================
$usernameRegexp ="/^[\p{L}0-9._-]{2,100}$/u";


  // =======================
  // username vide ?
  // =======================
  if(empty($username)){
    $error="Veuillez renseigner votre pseudo !";
  }
  // =======================
  // username trop long
  elseif (strlen($username) > 100){
    $error = "Votre pseudo es trop long !";
  }
  // ====================================
  // username est un e-mail ?
  // ====================================
  elseif (filter_var($username,FILTER_VALIDATE_EMAIL)){
    $error="Veuillez ne pas utiliser d'e-mail comme pseudo !"
      }
      // ==========================================================================
      // contient uniquement des lettres , des chiffres et des tirets et underscore
      // ==========================================================================
      elseif (condition) {
        # code...
      }
  else {
    // ==================================
    // e-mail déjà présent dans la base ?
    // ==================================
    $sql="SELECT username FROM users WHERE username= :username";
    $sth = $dbh->prepare ($sql);
    // ================================
    //  l'array remplace le bindValue()
    // ================================
    $sth->execute(array(":username" => $username));
    $foundUsername = $sth->fetchColumn();

    if ($foundUsername) {
      $error ="Ce pseudo est déja utilisé";
    }
  }
  // ===============================
  // mot de passe identique?
  // ===============================
  if($password != $password_confirm){
    $error ="Vos mot de passe ne sont pas identique !";
  }
  elseif (strlen($password)<=6) {
    $error="Veuillez utiliser un mot de passe d'au moins 7 lettres ";
  }
  // =======================
  // si on a pas d'erreur
  // en d'autre mots, si notre variable est encore vierge
  // =======================================================

  if(empty($error)){

    // ======================
  // insert dans la table users
// ==========================

  $sql = "INSERT INTO users(id, email, username, password , date_created, date_modified)
          VALUES(NULL,  :email, :username, :password, NOW(),NULL)";

 $sth=$dbh->prepare($sql);
// ================================================
// on donne une valeur aux paramètres de la requête
// ================================================
 $sth->bindValue (":email", $email);
 $sth->bindValue (":username", $username);

 $hashedPassword =password_hash($password,PASSWORD_DEFAULT);
 $sth->bindValue (":password", $hashedPassword);
 $sth->execute();


 }
}
?>
<!DOCTYPE html>
<html lang='FR-fr'>
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
	  <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div class="container">
      <fieldset>
      <header>

        <h1>Inscription !</h1>
      </header>
      <form class="form" method="POST">
        <div>
          <label for="email">Votre e-mail</label>
          <input type="email" name="email" id="email">
        </div>
        <div>
          <label for="username">Votre pseudo</label>
          <input type="text" name="username" id="username">
        </div>
        <div>
          <label for="password">Votre Mot de Passe</label>
          <input type="password" name="password" id="password">
        </div>
        <div>
          <label for="password_confirm">Encore une fois !</label>
          <input type="password" name="password_confirm" id="password_confirm">
        </div>
    </div>
    <button type="submit">OK !</button>
    </fieldset>
    <?php if(!empty($error)){
      echo "<div>" .$error . "</div>";
    }
    ?>

      </form>
    </div>
</body>
<footer>
  <?php include("footer.php"); ?>
</footer>
</html>
