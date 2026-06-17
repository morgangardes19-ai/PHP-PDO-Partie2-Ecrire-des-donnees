<?php require_once "../utils/db_connect.php";
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

<section class="flex justify-center overflow-hidden rounded-xl bg-white shadow-lg">

    <form action="../process/ajout-patient.php" method="post">
        <table>
            <thead>
                <tr>
                    <th>Informations du patient</th>
                    <th>Date du rendez-vous</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><label for="nom" class="bg-blue-900 text-white rounded-xl px-10 inline-block w-full">Indiquez ici le nom du patient :</label></td>
                    <td><input type="text" name="nom" id="nom" class="border border-black rounded-xl"></td>
                </tr>
                <tr>
                    <td><label for="prenom" class="bg-blue-900 text-white rounded-xl px-10 inline-block w-full">Indiquez ici le prénom du patient :</label></td>
                    <td><input type="text" name="prenom" id="prenom" class="border border-black rounded-xl"></td>
                </tr>
                <tr>
                    <td><label for="date" class="bg-blue-900 text-white rounded-xl px-10 inline-block w-full">Quelle est sa date de naissance ?</td>
                    <td><input type="date" name="date" id="date" class="border border-black rounded-xl"></td>
                </tr>
                <tr>
                    <td><label for="telephone" class="bg-blue-900 text-white rounded-xl px-10 inline-block w-full">Quel est son numéro de téléphone ?</label></td>
                    <td><input type="tel" name="telephone" id="telephone" class="border border-black rounded-xl"></td>
                </tr>
                <tr>
                    <td><label for="email" class="bg-blue-900 text-white rounded-xl px-10 inline-block w-full">A quelle adresse email est-il joignable ?</label></td>
                    <td><input type="email" name="email" id="email" class="border border-black rounded-xl"></td>
                </tr>
            </tbody>
        </table>
        <div class="flex justify-center ">
            <button type="submit" class="border-2 rounded xs border-black bg-blue-500 text-white px-2">Création du patient</button>
        </div>
    </form>
</section>

<?php require_once "../_partials/_footer.php" ?>