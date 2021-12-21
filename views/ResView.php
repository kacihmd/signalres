<?php $title = 'Nom de la ressource'; ?>

<?php ob_start(); ?>

 <h1 class="formulaire">
  Formulaire d'anomalie
  <form method="post" action="Connection.php">
  Nom d'utilisateur : <input type="text" name="User" placeholder="Enter User" id="input"/> </br>
  Mot de passe : <input type="password" name="Mdp" placeholder="Enter Password" id="input"/> </br> 
  <input type="submit" name="submit" value="valider" id="buttongreen"/>
  </form>
</h1>

<?php $content = ob_get_clean(); ?>

<?php require('MainView.php'); ?>