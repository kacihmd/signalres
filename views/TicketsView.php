<!-- Vue de la page responsable -->

  <!-- Affiche toutes les ressources associées au responsable connecté -->

<fieldset id="updateCrud">

    <legend>Tickets</legend>

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
                                    <li>id : <?=$ticket['idres']?></li>
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

        <form action="/update/ticket" method="post" class="modification">
            <input class="hidden_id_input" type="hidden" name="idTicket" value=""/>
            <input type="submit" value="Archiver"/>
        </form>

        <form action="/delete/ticket" method="post">
            <input class="hidden_id_input" type="hidden" name="idTicket"/>
            <input type="submit" value="Supprimer"/>
        </form>
    </div>

</fieldset>