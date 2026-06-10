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



<section class="flex justify-center overflow-hidden rounded-xl bg-white shadow-lg">
    <table class="">
        <form action="../process/ajout-patient.php" method="post" class="">
            <div class="">
                <div class="">
                    <tr>
                        <td><label for="nom">Indiquez ici le nom du patient :</label></td>
                        <td><input type="text" name="nom" id="nom" class="border border-black"></td>
                    </tr>
                </div>

                <div class="">
                    <tr>
                        <td><label for="prenom">Indiquez ici le prénom du patient :</label></td>
                        <td><input type="text" name="prenom" id="prenom" class="border border-black"></td>
                    </tr>
                </div>

                <div class="">
                    <tr>
                        <td><label for="date">Quelle est sa date de naissance ?</label></td>
                        <td><input type="date" name="date" id="date" class="border border-black"></td>
                    </tr>
                </div>

                <div class="">
                    <tr>
                        <td><label for="telephone">Quel est son numéro de téléphone ?</label></td>
                        <td><input type="tel" name="telephone" id="telephone" class="border border-black"></td>
                    </tr>
                </div>

                <div class="">
                    <tr>
                        <td><label for="email">A quelle adresse email est-il joignable ?</label></td>
                        <td><input type="email" name="email" id="email" class="border border-black"></td>
                    </tr>
                </div>
            </div>

            <div class="">
                <tr>
                    <td><button type="submit" class="border border-black">Création du patient</button></td>
                </tr>
            </div>
        </form>
    </table>
</section>


<?php require_once "../_partials/_footer.php" ?>