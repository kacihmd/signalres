<!-- Vue de la page administrateur -->

  <!-- Affiche tout les responsables -->

  <h1> Administration </h1>

<table>
    <thead>
        <tr>
            <th colspan="2">Responsables</th>
            <th colspan="2" rowspan="2">Actions</th>
        </tr>
        <tr>
            <th colspan="1">IdUser</th>
            <th colspan="1">UserName</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if ($users != null) {
                foreach ($users as $user) {
                    echo('<tr>  
                    <td>'.$user[0].'</td>
                    <td>'.$user[1].'</td>
                    <td>
                    <form method="post">
                    <input type="hidden" name="usertodelete" value="'.$user[0].'"/> 
                    <input type="submit" name="submit" value="Modifier" id="buttongreentable"/> </form>
                    </td>
                    <td>
                    <form method="post">
                    <input type="hidden" name="usertodelete" value="'.$user[0].'"/> 
                    <input type="submit" name="submit" value="Supprimer" id="buttonred"/> </form>
                    </td> </tr>');
                }
            }
        ?>
        <tr>
            <td>0</td>
            <td>admin</td>
            <td>Modifier</td>
            <td>Supprimer</td>
        </tr>
    </tbody>
</table>

<!-- Rajoute un nouveau responsable -->
<h1> Nouvelle responsable :</h1>
<div class="formulaire">
  <form method="post">
  Nom du responsable : <input type="text" name="username" placeholder="Entrer le nom du responsable" id="input"/> </br>
  <input type="submit" name="submit" value="Valider" id="buttongreen"/>
  </form>
</div>