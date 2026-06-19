<?php require_once "../utils/db_connect.php";

// Partie sécuritée
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header("Location: ../public/ajout-patient-rendez-vous.php?error=bad-method");
    exit();
}
if (!isset($_POST['nom']) || !isset($_POST['prenom']) || !isset($_POST['date']) || !isset($_POST['telephone']) || !isset($_POST['email']) || !isset($_POST['datehour'])) {
    header("Location: ../public/ajout-patient-rendez-vous.php?error=missing-value");
    exit();
}
if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['date']) || empty($_POST['telephone']) || empty($_POST['email']) || empty($_POST['datehour'])) {
    header("Location: ../public/ajout-patient-rendez-vous.php?error=empty-value");
    exit();
}


// Input sanitization
$nom = htmlspecialchars(trim($_POST['nom']));
$prenom = htmlspecialchars(trim($_POST['prenom']));
$birthDate = htmlspecialchars(trim($_POST['date']));
$tel = htmlspecialchars(trim($_POST['telephone']));
$email = htmlspecialchars(trim($_POST['email']));
$datehour = htmlspecialchars(trim($_POST['datehour']));
// $patient = htmlspecialchars(trim($_POST['patient']));

// var_dump($nom, $prenom, $birthDate, $tel, $email, $datehour);
// die();

// ================ REVOIR LES REQUÊTES ===============
$requestAjoutPatient = $db->prepare("INSERT INTO patients (lastname, firstname, birthdate, phone, mail) VALUES (:nom, :prenom, :birthDate, :tel, :email)");
$success = $requestAjoutPatient->execute([
    ":nom" => $nom,
    ":prenom" => $prenom,
    ":birthDate" => $birthDate,
    ":tel" => $tel,
    ":email" => $email
]);

$request2 = $db->prepare("INSERT INTO appointments (datehour) VALUES (:datehour)");
$request2->execute([
    ":datehour" => $datehour
]);

header("Location: ../public/ajout-patient-rendez-vous.php");
exit();
// ==================================================
?>