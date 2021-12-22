<!-- Vue de la page connexion -->

<?php $title = 'Connexion'; ?>

<?php ob_start(); ?>

<!-- Se connecte : Action ouvrir la session !!! -->

<h1 class="formulaire">
  <form method="post" action="####.php">
  Nom d'utilisateur : <input type="text" name="user" placeholder="Enter Username" id="input"/> </br>
  Mot de passe : <input type="password" name="mdp" placeholder="Enter Password" id="input"/> </br> 
  <input type="submit" name="submit" value="Connexion" id="buttongreen"/>
  </form>
</h1>  

<?php $content = ob_get_clean(); ?>

<?php require('MainView.php'); ?>