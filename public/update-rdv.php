<?php
require_once "../utils/db_connect.php";

if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'bad-method':
            echo "Mauvaise méthode";
            break;
    }
}
?>
<!-- PARTIE SECURITE  -->
<?php
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

$patientId = htmlspecialchars(trim($_GET['id']));
$request = $db->prepare("SELECT appointments.id, patients.lastname, patients.firstname, appointments.datehour FROM appointments JOIN patients ON patients.id = appointments.patient_id WHERE appointments.id = :id");
$request->execute([
    ":id" => $patientId
]);

$rdvEtPatient = $request->fetch(PDO::FETCH_ASSOC);
// var_dump($rdvEtPatient);
// die();

?>

<?php require_once "../_partials/_head.php" ?>

<section class="flex justify-center items-center overflow-hidden rounded-xl bg-white shadow-lg">
    <form action="../process/update-rdv.php" method="post">
        <div class="flex flex-col">
            <p>Nom du patient : <?= strtoupper($rdvEtPatient['lastname']) ?></p>
            <p>Prénom du patient : <?= $rdvEtPatient['firstname'] ?></p>

            <label for="date" class="bg-blue-900 text-white rounded-xl inline-block w-full px-4">Date et heure du rendez-vous</label>
            <input type="datetime-local" name="date" id="date" class="border border-black rounded-xl" value="<?= $rdvEtPatient['datehour'] ?>">
        </div>
        <div class = "flex justify-center">
            <input type="hidden" name="id" id="id" class="border border-black rounded-xl" value="<?= $rdvEtPatient['id'] ?>">

            <button type="submit" class="flex justify-center border-2 rounded xs border-black bg-blue-500 text-white px-2">Modifier</button>
        </div>
    </form>
</section>

<?php require_once "../_partials/_footer.php" ?>