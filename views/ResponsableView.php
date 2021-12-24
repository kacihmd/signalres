<!-- Vue de la page responsable -->

  <!-- Affiche toutes les ressources associées au responsable connecté -->

  <table>
    <thead>
        <tr>
            <th colspan="3">Ressources</th>
            <th colspan="2" rowspan="2">Actions</th>
        </tr>
        <tr>
            <th colspan="1">Description</th>
            <th colspan="1">Categorie</th>
            <th colspan="1">Localisation</th>
        </tr>
    </thead>
    <tbody>
        <?php
            print_r($res);

            if ($res != null) {
              if (is_array($res[0])) {
                foreach ($res as $ressource) {
                    echo('<tr>  
                    <td>'.$ressource[1].'</td>
                    <td>'.$ressource[2].'</td>
                    <td>'.$ressource[3].'</td>
                    <td>Modifier</td>
                    <td>Supprimer</td></tr>');
                }
              }
              else {
                echo('<tr>  
                    <td>'.$res[1].'</td>
                    <td>'.$res[2].'</td>
                    <td>'.$res[3].'</td>
                    <td>Modifier</td>
                    <td>Supprimer</td></tr>');
              }
            }
        ?>
    </tbody>
</table>

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