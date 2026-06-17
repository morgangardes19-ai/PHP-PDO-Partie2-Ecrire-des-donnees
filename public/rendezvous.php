<?php
require_once "../utils/db_connect.php";

// ETAPE DE SECURITE
if ($_SERVER['REQUEST_METHOD'] !== "GET") {
    header("Location: ./liste-rendezvous.php?error=bad-method");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: ./liste-rendezvous.php?error=missing-value");
    exit();
}

if (empty($_GET['id'])) {
    header("Location: ./liste-rendezvous.php?error=value-empty");
    exit();
}

// INPUT SANITIZATION
$id = htmlspecialchars(trim($_GET["id"]));

$request = $db->prepare("SELECT * FROM appointments JOIN patients ON patients.id = appointments.patient_id WHERE appointments.id = :id");
$request->execute([
    ":id" => $id,
]);
$detailRdv = $request->fetch(PDO::FETCH_ASSOC);

// var_dump($detailRdv);
?>

<?php require_once "../_partials/_head.php" ?>

<section class ="overflow-hidden rounded-xl bg-white shadow-lg flex flex-col justify-center items-center">
    <p>Prénom : <?= htmlspecialchars($detailRdv['firstname']) ?></p>
    <p>Nom : <?= htmlspecialchars($detailRdv['lastname']) ?></p>
    <p>Date de naissance : <?= htmlspecialchars($detailRdv['birthdate']) ?></p>
    <p>Numéro de téléphone : <?= htmlspecialchars($detailRdv['phone']) ?></p>
    <p>Adresse email : <?= htmlspecialchars($detailRdv['mail']) ?></p>
    <p>Date et heure du rendez-vous : <?= htmlspecialchars($detailRdv['datehour']) ?></p>
</section>

<?php require_once "../_partials/_footer.php" ?>