<!-- A définir ici la vue de page générale -->
<!-- Par exemple le menu qui s'affiche partout, le footer etc... -->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="/public/images/logo.png" rel="icon">
        <link href="/public/css/main.css" rel="stylesheet" />

        <?php
            if ($cssIncludes != null) {
                foreach ($cssIncludes as $file) {
                    echo('<link href="'.$file.'" rel="stylesheet">');
                }
            }
            if ($jsIncludes != null) {
                foreach ($jsIncludes as $file) {
                    echo('<script type="text/javascript" src="'.$file.'"></script>');
                }
            }
        ?>
    </head>

    <body>

        <!-- En tête de la page -->
        <header class="mainHeader">
            <img class="logo" src="/public/images/logo.png">
            <div class="navigation">
                <?php if($admin) {
                        echo('<a href="/admin">Admin</a>');
                    } 
                ?>
                <?php if($session) {
                        echo('<a href="/ressource">Ressources</a>');
                    } 
                ?>
                <a href="/menu">Menu</a>
                <?php if($session) {
                        echo('<a href="/logout">Déconnexion</a>');
                    } else {
                        echo('<a href="/login">Connexion</a>');
                    }
                ?>
            </div>
        </header>

        <!-- Contenu inséré dynamiquement -->
        <div class="content">
            <?= $content ?>
        </div>

        <!-- Pied de page -->
        <div class="footer"> 
            SignalRes : Dites nous tous vos problèmes !
        </div>

    </body>

</html>