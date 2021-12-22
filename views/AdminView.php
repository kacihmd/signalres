<!-- Vue de la page administrateur -->

<?php $title = 'Page Admin'; ?>

<?php ob_start(); ?>

  <!-- Affiche tout les responsables -->

<?php $content = ob_get_clean(); ?>

<?php require('MainView.php'); ?>