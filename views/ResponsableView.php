<!-- Vue de la page responsable -->

<?php $title = 'Page Responsable'; ?>

<?php ob_start(); ?>

  <!-- Affiche toutes les ressources du responsable connecté -->

<?php $content = ob_get_clean(); ?>

<?php require('MainView.php'); ?>