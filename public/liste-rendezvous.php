<?php
require_once "../utils/db_connect.php";

// $request = $db->query("SELECT * FROM appointments JOIN patients ON patients.id = appointments.patient_id ORDER BY datehour DESC");
// $rdvs = $request->fetchAll(PDO::FETCH_ASSOC);

// var_dump($rdvs);

//  ============== Finir la requête prepare qui prend uniquement : lastname, firstname, datehour, il faut l'id aussi ? ==================
$request = $db->prepare("SELECT patients.lastname, patients.firstname FROM patients JOIN appointments ON patients.id = appointments.patient_id WHERE patients.id = :");
$request->execute([
    ":" => $
]);
$rdvs = $request->fetch(PDO::FETCH_ASSOC);

var_dump($rdvs);
// =======================================================================================================================================

if (isset($_GET['create']) && !empty($_GET['create'])) {
    $createSuccess = htmlspecialchars(trim($_GET['create']));
}

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

    <?php if (isset($createSuccess) && $createSuccess === "1") { ?>

        <!-- Message de confirmation de creation de patient -->
        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">
            Le rendez-vous a bien été ajouté à la liste.
        </div>

    <?php } ?>

    <!-- Tableau -->
    <div class="overflow-hidden rounded-xl bg-white shadow-lg">
        <table class="w-full">

            <thead class="bg-blue-900 text-white">
                <tr>
                    <th class="px-6 py-4 text-left">Nom</th>
                    <th class="px-6 py-4 text-left">Prénom</th>
                    <th class="px-6 py-4 text-center">Date et Heure du Rendez-vous</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($rdvs as $rdv) { ?>
                    <tr class="border-b hover:bg-blue-50 transition">
                        <td class="px-6 py-4 font-medium text-slate-800">
                            <?= htmlspecialchars($rdv['lastname']) ?>
                        </td>

                        <td class="px-6 py-4 text-slate-600">
                            <?= htmlspecialchars($rdv['firstname']) ?>
                        </td>

                        <td class="px-6 py-4 text-slate-600">
                            <?= htmlspecialchars($rdv['datehour']) ?>
                        </td>
                    </tr>

                <?php } ?>
                <div class="mt-8 flex justify-center">
                    <a
                        href="../public/ajout-rendezvous.php"
                        class="rounded-lg bg-slate-700 px-6 py-3 text-white hover:bg-slate-800 transition">
                        Redirigez-vous vers la création de rendez-vous
                    </a>
                </div>
            </tbody>
        </table>
    </div>
</div>

<?php require_once "../_partials/_footer.php" ?>