<?php

    // MainController : Classe abstraite dont les autres controllers hériteront.
    // Contient la méthode render affichant le menu de navigation sur chaque page,
    // en incluant le contenu donné par chaque controller.
    abstract class MainController {

        private String $title = "";

        // title : Titre de la page rendue
        public function __construct(String $title) {
            assert($title != NULL);
            $this->title = $title;
        }

        // Inclue dans head les fichiers dont les chemins sont 
        // contenus dans $cssIncludes et $jsIncludes
        // Inclut $content dans MainView puis affiche le résultat.  
        protected function render($cssIncludes, $jsIncludes, $content) {

            // Affiche la vue principale MainView
            $title = $this->title;
            require(__DIR__.'/../views/MainView.php');
        }
    }

?>