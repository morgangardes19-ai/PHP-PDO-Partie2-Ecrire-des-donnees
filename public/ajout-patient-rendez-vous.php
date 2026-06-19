<?php require_once "../utils/db_connect.php";

// On verifie si on a reçu l'information, d'un succès de creation de patient
if (isset($_GET['create']) && !empty($_GET['create'])) {
    $createSuccess = htmlspecialchars(trim($_GET['create']));
}
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

<!-- Message de confirmation de creation de patient -->
<?php if (isset($createSuccess) && $createSuccess === "1") { ?>
    <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">
        Le patient a bien été ajouté à la liste.
    </div>
<?php } ?>


<!-- Formulaire -->
<section class="flex flex-row justify-center">
    <form action="../process/ajout-patient-rendez-vous.php" method="post" class="flex flex-col gap-4 border px-4 py-4">

        <label for="nom" class="bg-blue-900 text-white rounded-xl px-10 inline-block w-full">Indiquez ici le nom du patient :</label>
        <input type="text" name="nom" id="nom" class="border border-black rounded-xl">

        <label for="prenom" class="bg-blue-900 text-white rounded-xl px-10 inline-block w-full">Indiquez ici le prénom du patient :</label>
        <input type="text" name="prenom" id="prenom" class="border border-black rounded-xl">

        <label for="date" class="bg-blue-900 text-white rounded-xl px-10 inline-block w-full">Quelle est sa date de naissance ? </label>
        <input type="date" name="date" id="date" class="border border-black rounded-xl">

        <label for="telephone" class="bg-blue-900 text-white rounded-xl px-10 inline-block w-full">Quel est son numéro de téléphone ?</label>
        <input type="tel" name="telephone" id="telephone" class="border border-black rounded-xl">

        <label for="email" class="bg-blue-900 text-white rounded-xl px-10 inline-block w-full">A quelle adresse email est-il joignable ?</label>
        <input type="email" name="email" id="email" class="border border-black rounded-xl">

        <label for="datehour" class="font-bold">Date et Heure du Rendez-vous :</label>
        <input type="datetime-local" name="datehour" id="datehour">

        <button type="submit" class="border-2 rounded xs border-black bg-blue-500 text-white px-2">Créer le patient et son rendez-vous</button>
    </form>
</section>

<?php require_once "../_partials/_footer.php" ?>