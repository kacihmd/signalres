<?php

    abstract class MainController {

        private String $title = "";

        public function __construct(String $title) {
            assert($title != NULL);

            $this->title = $title;
            session_start();
        }

        // Cette fonction active le rendu de la page
        protected function render($includes, $content) {
            // Affiche $content dans la vue principale MainView
            $title = $this->title;
            require(__DIR__.'/../views/MainView.php');
        }
    }

?>