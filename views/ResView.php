<!-- Vue de la page responsable -->

  <!-- Affiche toutes les ressources associées au responsable connecté -->

<table>
    <thead>
        <tr>
            <th colspan="1">Identifiant</th>
            <th colspan="1">Description</th>
            <th colspan="1">Categorie</th>
            <th colspan="1">Localisation</th>
            <th colspan="1">Responsable</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if ($res != null) {
                foreach ($res as $ressource) {
                    echo('<tr>');
                    foreach ($ressource as $key => $category) {
                        echo('<td>'.$category.'</td>');
                    } 
                    echo('</tr>');
                }
            }
        ?>
    </tbody>
</table>

<div class="modification">
    <form action="/update/res" method="post">
        <fieldset>
            <input type="text" name="desc" 
                placeholder="Description..." size="10" />
            <br>

            <input type="text" name="cat" 
                placeholder="Catégorie..." size="10" />
            <br>

            <input type="text" name="loc" 
                placeholder="Localisation..." size="10" />
            <br>

            <?php if (isset($users)) {?>
            <label for="resp">Responsable :</label>
            <select name="resp">
                <?php
                    foreach ($users as $key => $user) {
                        echo('<option value="'.$user[0].'">'.$user[0].'</option>');
                    }
                ?>
            </select>
            <br>
            <?php } ?>

            <input class="hidden_id_input" type="hidden" name="id" value=""/>
            <input type="submit" value="Modifier"/>
        </fieldset>
    </form>

    <form action="/delete/res" method="post">
        <fieldset>
            <input class="hidden_id_input" type="hidden" name="id"/>
            <input type="submit" value="Supprimer"/>
        </fieldset>
    </form>
</div>




<!-- Rajoute une nouvelle ressource -->
<h1> Nouvelle ressource :</h1>

<div class="formulaire">

    <form method="post">
        Description : <input type="text" name="description" placeholder="Entrer une description de la ressource" id="input"/> </br>
        Categorie : <input type="text" name="categorie" placeholder="Entrer la categorie de la ressource" id="input"/> </br> 
        Localisation : <input type="text" name="localisation" placeholder="Entrer la localisation de la ressource" id="input"/> </br> 
        <input type="submit" name="submit" value="Valider" id="buttongreen"/>
    </form>

</div>