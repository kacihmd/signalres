<?php

    abstract class MainController {

        private String $title = "";

        public function __construct(String $title) {
            assert($title != NULL);

            $this->title = $title;
        }

        // Cette fonction active le rendu de la page
        protected function render($cssIncludes, $jsIncludes, $content) {
            $session=false;
            $admin=false;

            if(isset($_SESSION['iduser']) && $_SESSION['iduser']!=null) {
                $session=true;
                if($_SESSION['iduser']==1) {
                    $admin=true;
                }
            }

            // Affiche $content dans la vue principale MainView
            $title = $this->title;
            require(__DIR__.'/../views/MainView.php');
        }
    }

?>