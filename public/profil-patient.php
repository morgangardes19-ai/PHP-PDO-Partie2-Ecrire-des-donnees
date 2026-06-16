<?php
require_once "../utils/db_connect.php";

if ($_SERVER['REQUEST_METHOD'] !== "GET") {
    header("Location: ./liste-patient.php?error=bad-method");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: ./liste-patient.php?error=missing-value");
    exit();
}

if (empty($_GET['id'])) {
    header("Location: ./liste-patient.php?error=value-empty");
    exit();
}


// INPUT SANITIZATION

$patientId = htmlspecialchars(trim($_GET['id']));


$request = $db->prepare("SELECT * FROM patients WHERE patients.id = :id");
$request->execute([
    ":id" => $patientId
]);

$clientUnique = $request->fetch(PDO::FETCH_ASSOC);


$request = $db->prepare("SELECT * FROM appointments WHERE appointments.patient_id = :id");
$request->execute([
    ":id" => $patientId
]);

$rdvs = $request->fetchAll(PDO::FETCH_ASSOC);
// var_dump($rdvs);
// die();
?>

<?php require_once "../_partials/_head.php" ?>

<!-- Tableau -->
<div class="overflow-hidden rounded-xl bg-white shadow-lg">
    <table class="w-full">

        <thead class="bg-blue-900 text-white">
            <tr>
                <th class="px-6 py-4 ">Id</th>
                <th class="px-6 py-4">Nom</th>
                <th class="px-6 py-4">Prénom</th>
                <th class="px-6 py-4">Date de naissance</th>
                <th class="px-6 py-4">Téléphone</th>
                <th class="px-6 py-4">Email</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-b hover:bg-blue-50 transition">
                <td class="px-6 py-4  text-slate-800 text-center">
                    <?= $clientUnique['id'] ?>
                </td>
                <td class="text-slate-800 text-center">
                    <?= $clientUnique['lastname'] ?>
                </td>
                <td class="text-slate-800 text-center">
                    <?= $clientUnique['firstname'] ?>
                </td>
                <td class="text-slate-800 text-center">
                    <?= $clientUnique['birthdate'] ?>
                </td>
                <td class="text-slate-800 text-center">
                    <?= $clientUnique['phone'] ?>
                </td>
                <td class="text-slate-800 text-center">
                    <?= $clientUnique['mail'] ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>



<!-- PARTIE AFFICHAGE LISTE DE RDV DU PATIENT -->
<div class="overflow-hidden bg-white shadow-lg flex justify-center">
    <?php 
    if (empty($rdvs)) { ?>
        <p>Pas de rendez-vous prévu</p>
   <?php } else { ?>
    
   
    <table class="w-100 border-2">

        <thead class="bg-blue-900 text-white">
            <tr>
                <th class="px-4 py-2 text-center">Date et heure de ses rendez-vous</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rdvs as $rdv) { ?>
                <td class="px-6 py-4 text-slate-600 text-center">
                    <?= htmlspecialchars($rdv['datehour']) ?>
                </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>
</div>
<?php require_once "../_partials/_footer.php" ?>