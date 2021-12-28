
<!-- A définir ici la vue de page générale -->
<!-- Par exemple le menu qui s'affiche partout, le footer etc... -->

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />

        <title>Etiquette Ressource</title>

        <link href="/public/images/logo.png" rel="icon">
        <link href="/public/css/print.css" rel="stylesheet" />
    </head>

    <body>

        <div id="etiquette">

            <div id="desc">
                <p>Flashez moi pour signaler un problème !</p>
                <p><?= $this->url.$resId ?></p>
            </div>

            <img id="qrcode" src="<?= $this->api.$this->url.$resId ?>" alt="qrcode"/>

        </div>

    </body>

</html>
