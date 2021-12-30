<!-- Vue de la page administrateur -->
 <!-- Affiche tous les responsables -->

    <fieldset id="updateCrud">

    <legend>Responsables</legend>

        <table>
            <tbody>
                <?php
                    if ($users != null) {
                        foreach ($users as $user) {
                            echo('
                                <tr>
                                    <td>'.$user[1].'</td>
                                </tr>'
                            );
                        }
                    }
                ?>
            </tbody>
        </table>

        <div class="modification">
            <form action="/update/user" method="post">
                <fieldset>
                    <legend>Modifer un repsonsable</legend>
                    <input type="text" name="username" 
                        placeholder="Nom d'utilisateur..." size="15" />
                    <input type="text" name="password" 
                        placeholder="Mot de Passe..." size="15"/>

                    <br>

                    <input class="hidden_id_input" type="hidden" name="id" value=""/>
                    <input type="submit" value="Modifier"/>
                </fieldset>
            </form>

            <form action="/delete/user" method="post">
                    <input class="hidden_id_input" type="hidden" name="id"/>
                    <input type="submit" value="Supprimer"/>
            </form>
        </div>

    </fieldset>

    <div class="formulaire">
    <!-- Rajoute un nouveau responsable -->
    <form method="post" action="/add/user">
        <fieldset>
            <legend>Ajouter un responsable</legend>
            <input type="text" name="username" placeholder="Nom d'utilisateur..." size="15"/> 
            <br>      
            <input type="text" name="password" placeholder="Mot de passe..." size="15"/>
            <br>
            <input type="submit" value="Ajouter"/>
        </fieldset>
    </form>
    </div>