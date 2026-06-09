<?php require_once "../utils/db_connect.php";

// var_dump($db);
?>

<?php require_once "../_partials/_head.php" ?>

<?php 
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'bad-method':
            echo "Mauvaise méthode";
            break;
    }
}
?>

<!-- Créer une page ajout-patient.php et y créer un formulaire permettant de créer un patient. Elle doit être accessible depuis la page index.php. -->
<section class="flex flex-col items-center justify-center border border-solid bg-blue-300">
    <form action="../process/ajout-patient.php" method="post">
        <div>
            <label for="nom">Indiquez ici votre nom</label>
            <input type="text" name="nom" id="nom">
        </div>

        <div>
            <label for="prenom">Indiquez ici votre prénom</label>
            <input type="text" name="prenom" id="prenom">
        </div>

        <div>
            <label for="date">Quelle est votre date de naissance ?</label>
            <input type="date" name="date" id="date">
        </div>

        <div>
            <label for="telephone">Quel est votre numéro de téléphone</label>
            <input type="tel" name="telephone" id="telephone">
        </div>

        <div>
            <label for="email">A quelle adresse email êtes-vous joignable ?</label>
            <input type="email" name="email" id="email">
        </div>

        <div>
            <button type="submit">Création du patient</button>
        </div>
    </form>
</section>


<?php require_once "../_partials/_footer.php" ?>