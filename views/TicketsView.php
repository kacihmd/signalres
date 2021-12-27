<!-- Vue de la page responsable -->

  <!-- Affiche toutes les ressources associées au responsable connecté -->

  <fieldset id="updateRes">
    <legend>Modifier une ressource</legend>

    <table>
        <thead>
            <tr>
                <th colspan="1">Numero Ticket</th>
                <th colspan="1">Ressource</th>
                <th colspan="1">Anomalie</th>
                <th colspan="1">Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if ($tickets != null) {
                    foreach ($tickets as $ticket) {
            ?>
                        <tr>
                            <td> <?=$ticket['idtickets']?> </td>
                            <td>
                                <ul>
                                    <li><?=$ticket['idres']?></li>
                                    <li><?=$ticket['description']?></li>
                                    <li><?=$ticket['categorie']?></li>
                                    <li><?=$ticket['localisation']?></li>
                                </ul>
                            </td>
                            <td> <?=$ticket['descprobl']?> </td>
                            <td> <?= ($ticket['signaldate'] == null)?"no date":$ticket['signaldate'] ?> </td>
                        </tr>
            <?php
                    }
                }
            ?>
        </tbody>
    </table>
    
    <div class="modification">

        <form action="/update/res" method="post" class="modification">
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
                <input class="hidden_id_input" type="hidden" name="idres"/>
                <input type="submit" value="Supprimer"/>
            </fieldset>
        </form>
    </div>

</fieldset>


<!-- Rajoute une nouvelle ressource -->
    <form method="post" action="/add/res" id="addRes">
        <fieldset>
            <legend>Ajouter une ressource</legend>
            <input type="text" name="desc" placeholder="Description..." size="10"/>
            <br>      
            <input type="text" name="cat" placeholder="Catégorie..." size="10"/> 
            <br>
            <input type="text" name="loc" placeholder="Localisation..." size="10"/>
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

            <br>
            <input type="submit" value="Ajouter"/>
        </fieldset>
    </form>

</div>