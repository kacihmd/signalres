<!-- Vue de la page responsable -->

  <!-- Affiche toutes les ressources associées au responsable connecté -->

<fieldset id="updateRes">
    <legend>Modifier une ressource</legend>

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

        <form action="/update/res" method="post" class="modification">
            <fieldset>
                <input type="text" name="desc" 
                    placeholder="Description..." size="15" />
                <br>

                <input type="text" name="cat" 
                    placeholder="Catégorie..." size="15" />
                <br>

                <input type="text" name="loc" 
                    placeholder="Localisation..." size="15" />
                <br>

                <?php if (isset($users)) {?>
                <label for="selectUpdateRes">Responsable :</label>
                <select name="resp" id="selectUpdateRes">
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

        <div id="gestionButtons">

            <form method="post" id="impr" target="_blank">
                <fieldset>
                    <input type="submit" value="Imprimer"/>
                </fieldset>
            </form>

            <form action="/delete/res" method="post">
                <fieldset>
                    <input class="hidden_id_input" type="hidden" name="idres"/>
                    <input type="submit" value="Supprimer"/>
                </fieldset>
            </form>

        </div>

        
    </div>

</fieldset>


<!-- Rajoute une nouvelle ressource -->
    <form method="post" action="/add/res" id="addRes">
        <fieldset>
            <legend>Ajouter une ressource</legend>
            <input type="text" name="desc" placeholder="Description..." size="15"/>
            <br/>      
            <input type="text" name="cat" placeholder="Catégorie..." size="15"/> 
            <br/>
            <input type="text" name="loc" placeholder="Localisation..." size="15"/>
            <br/>

            <?php if (isset($users)) {?>
                <label for="selectAddRes">Responsable :</label>
                <select name="resp" id="selectAddRes">
                    <?php
                        foreach ($users as $key => $user) {
                            echo('<option value="'.$user[0].'">'.$user[0].'</option>');
                        }
                    ?>
                </select>
                <br>
            <?php } ?>

            <br>
            <input type="submit" value="Ajouter"/>
        </fieldset>
    </form>