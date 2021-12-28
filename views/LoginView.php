<!-- Vue de la page connexion -->

<!-- Se connecte : Action ouvrir la session !!! -->
<h1> Connexion </h1>

<div class="formulaire">
    <form method="post">
        
        <label for="userinput">Nom d'utilisateur : </label>
        <input type="text" name="user" id="userinput" placeholder="(ಠ_ಠ)" /> 
        <br/>
        
        <label for="mdpinput">Mot de passe :</label>
        <input type="password" name="mdp" id="mdpinput" placeholder="(╯°□°）╯ ︵ ┻━┻"/> 
        <br/>

        <input type="submit" name="submit" value="Connexion" id="buttongreen"/>
    </form>
</div>  

<?php 

    if (isset($_GET['failure'])) {
        echo('<p id="failure"> Identifiant ou mot de passe Incorrect... :( </p>');
    }

?>