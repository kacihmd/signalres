<!-- Vue de la page rapport d'anomalie -->

<div class="ressource">

    <?= $res['categorie'] ?>

</div>

<form method="post">
    <label for="anomalie">Description de l'anomalie :</label>
    <input type="text" name="anomalie" 
           placeholder="Racontez nous ce qu'il se passe !" id="input"/> 
    <br>
    <input type="submit" name="submit" value="Signaler" id="buttongreen"/>
</form>

  