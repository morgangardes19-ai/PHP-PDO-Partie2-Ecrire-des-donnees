<?php
require_once "../utils/db_connect.php";

$request = $db->query("SELECT * FROM patients ORDER BY lastname ASC");
$patients = $request->fetchAll(PDO::FETCH_ASSOC);

// On verifie si on a reçu l'information, d'un succès de creation de patient
if (isset($_GET['create']) && !empty($_GET['create'])) {
    $createSuccess = htmlspecialchars(trim($_GET['create']));
}
?>

<?php require_once "../_partials/_head.php" ?>

<div class="min-h-screen p-8">

    <!-- Titre -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-blue-900">
            Liste des patients
        </h1>
        <p class="text-slate-600 mt-2">
            Consultez les patients enregistrés dans l'établissement.
        </p>
    </div>

    <?php if (isset($createSuccess) && $createSuccess === "1") { ?>

        <!-- Message de confirmation de creation de patient -->
        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">
            Le patient a bien été ajouté à la liste.
        </div>

    <?php } ?>

    <!-- Tableau -->
    <div class="overflow-hidden rounded-xl bg-white shadow-lg">
        <table class="w-full">

            <thead class="bg-blue-900 text-white">
                <tr>
                    <th class="px-6 py-4 text-left">Nom</th>
                    <th class="px-6 py-4 text-left">Prénom</th>
                    <th class="px-6 py-4 text-center">Action</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($patients as $patient) { ?>
                    <tr class="border-b hover:bg-blue-50 transition">
                        <td class="px-6 py-4 font-medium text-slate-800">
                            <?= htmlspecialchars($patient['lastname']) ?>
                        </td>

                        <td class="px-6 py-4 text-slate-600">
                            <?= htmlspecialchars($patient['firstname']) ?>
                        </td>

                        <td class="px-6 py-4 flex justify-center gap-4">

                            <a
                                href="./profil-patient.php?id=<?= $patient['id'] ?>">
                                <img src="../assets/images/voir.png" alt="profil patient" class=" hover:scale-110 transition">
                            </a>
                            <a
                                href="#">
                                <img src="../assets/images/stylo.png" alt="modifier patient" class=" hover:scale-110 transition">
                            </a>
                            <a
                                href="#">
                                <img src="../assets/images/supprimer.png" alt="modifier patient" class=" hover:scale-110 transition">
                            </a>

                        </td>
                    </tr>

                <?php } ?>

            </tbody>

        </table>
    </div>

    <!-- Bouton retour -->
    <div class="mt-8 flex justify-center">
        <a
            href="../public/ajout-patient.php"
            class="rounded-lg bg-slate-700 px-6 py-3 text-white hover:bg-slate-800 transition">
            Ajouter un nouveau patient
        </a>
    </div>

</div>

<?php require_once "../_partials/_footer.php" ?>