<!-- Vue de la page rapport d'anomalie -->

<div class="ressource">

    <ul>
        <li>Description : <?= $res['description'] ?></li>
        <li>Catégorie : <?= $res['categorie'] ?></li>
        <li>Localisation : <?= $res['localisation'] ?></li>
    </ul>

</div>

<form method="POST" action="/add/signal/<?= $res['idres'] ?>">

    <?php if (isset($anomaliesOfRes)) {?>
        <label for="resp">Selectionnez votre problème dans la liste : </label>
        <select name="idAnomalie" id="anoSelect">
            <?php
                foreach ($anomaliesOfRes as $value) {
                    echo('<option value="'.$value['idanomalie'].'">'.$value['descprobl'].'</option>');
                }
            ?>
            <option value="0"> Je ne trouve pas mon problème :( </option>
        </select>
        <br>
    <?php } ?>
    
    <label for="newAnomalie">Si vous ne trouvez pas votre bonheur, pas de soucis...</label>
    <input type="text" name="newAnomalie" id="newAnomalie"
           placeholder="Racontez nous ce qu'il se passe !" size="30"/> 
    <input type="submit" name="submit" value="Signaler"/>

    <?php 
        if (isset($_GET['success'])) {
            echo '<p style="color: red;"> Merci pour votre aide ! :) </p>';
        }
    ?>

</form>

  