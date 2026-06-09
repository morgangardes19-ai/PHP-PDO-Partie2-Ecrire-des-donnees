<?php require_once "../utils/db_connect.php";

// var_dump($db);
?>

<?php require_once "../_partials/_head.php" ?>

<!-- Créer une page ajout-patient.php et y créer un formulaire permettant de créer un patient. Elle doit être accessible depuis la page index.php. -->
<section class="border border-solid bg-blue-300 flex flex-col items-center justify-center">
    <form action="../process/ajout-patient.php" method="post">
        <div>
            <label for="nom">Nom du patient</label>
            <input type="text" name="nom" id="nom">
        </div>

        <div>
            <label for="prenom">Prénom du patient</label>
            <input type="text" name="prenom" id="prenom">
        </div>

        <div>
            <label for="date">Date de naissance</label>
            <input type="date" name="date" id="date">
        </div>

        <div>
            <label for="telephone">Numéro de téléphone</label>
            <input type="tel" name="telephone" id="telephone">
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
        </div>

        <div>
            <button type="submit">Création du patient</button>
        </div>
    </form>
</section>


<?php require_once "../_partials/_footer.php" ?>