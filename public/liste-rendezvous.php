<?php
require_once "../utils/db_connect.php";

if (isset($_GET['create']) && !empty($_GET['create'])) {
    $createSuccess = htmlspecialchars(trim($_GET['create']));
}

$request = $db->query("SELECT patients.lastname, patients.firstname, appointments.datehour, appointments.id FROM patients JOIN appointments ON patients.id = appointments.patient_id");

$rdvs = $request->fetchAll(PDO::FETCH_ASSOC);
?>



<?php require_once "../_partials/_head.php" ?>

<div class="min-h-screen p-8">

    <!-- Titre -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-blue-900">
            Liste de rendez-vous des patients
        </h1>
        <p class="text-slate-600 mt-2">
            Consultez les rendez-vous des patients enregistrés dans l'établissement.
        </p>
    </div>

     <!-- Message de confirmation de creation de patient -->
    <?php if (isset($createSuccess) && $createSuccess === "1") { ?>
        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">
            Le rendez-vous a bien été ajouté à la liste.
        </div>
    <?php } ?>

    <!-- Tableau -->
    <div class="overflow-hidden rounded-xl bg-white shadow-lg">
        <table class="w-full">

            <thead class="bg-blue-900 text-white">
                <tr>
                    <th class="px-6 py-4 text-center">Nom</th>
                    <th class="px-6 py-4 text-center">Prénom</th>
                    <th class="px-6 py-4 text-center">Date et Heure du Rendez-vous</th>
                    <th class="px-6 py-4 text-center">Détail</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rdvs as $rdv) { ?>
                    <tr class="border-b hover:bg-blue-50 transition">
                        <td class="px-6 py-4 font-medium text-slate-800 text-center">
                            <?= htmlspecialchars(strtoupper($rdv['lastname'])) ?>
                        </td>

                        <td class="px-6 py-4 text-slate-600 text-center">
                            <?= htmlspecialchars($rdv['firstname']) ?>
                        </td>

                        <td class="px-6 py-4 text-slate-600 text-center">
                            <?= htmlspecialchars($rdv['datehour']) ?>
                        </td>
                        <td class="px-6 py-4 text-slate-600 flex justify-center gap-4">
                            <a
                                href="./rendezvous.php?id=<?= $rdv['id'] ?>">
                                <img src="../assets/images/voir.png" alt="detail patient" class=" hover:scale-110 transition">
                            </a>
                            <a
                                href="./update-rdv.php?id=<?= $rdv['id'] ?>">
                                <img src="../assets/images/stylo.png" alt="modifier patient" class=" hover:scale-110 transition">
                            </a>
                            <a
                                href="../process/delete-rdv.php?id=<?= $rdv['id'] ?>">
                                <img src="../assets/images/supprimer.png" alt="supprimer patient" class=" hover:scale-110 transition">
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="mt-8 flex justify-center">
        <a
            href="../public/ajout-rendezvous.php"
            class="rounded-lg bg-slate-700 px-6 py-3 text-white hover:bg-slate-800 transition">
            Redirigez-vous vers la création de rendez-vous
        </a>
    </div>
</div>

<?php require_once "../_partials/_footer.php" ?>