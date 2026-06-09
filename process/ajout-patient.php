<?php require_once "../utils/db_connect.php"; ?>

<?php 
session_start();
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$birthDate = $_POST['date'];
$tel = $_POST['telephone'];
$email = $_POST['email'];
// var_dump($nom, $prenom,$birthDate, $tel, $email);


// Partie sécuritée
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header("Location: ../public/ajout-patient.php?error=bad-method");
    exit();
}
// if (!isset($_POST['nom']) || ($_POST['prenom']) || ($_POST['date']) || ($_POST['telephone']) || ($_POST['email'])) {
//     header("Location: ../public/ajout-patient.php?error=bad-method");
//     exit();
// }


// Input sanitization
$nom = htmlspecialchars(trim($_POST['nom']));
$prenom = htmlspecialchars(trim($_POST['prenom']));
$birthDate = htmlspecialchars(trim($_POST['date']));
$tel = htmlspecialchars(trim($_POST['telephone']));
$email = htmlspecialchars(trim($_POST['email']));




$request = $db->prepare("INSERT INTO patients (lastname, firstname, birthdate, phone, mail) VALUES (:nom, :prenom, :birthDate, :tel, :email)");
$request->execute([
    ":nom" => $nom,
    ":prenom" => $prenom,
    ":birthDate" => $birthDate,
    ":tel" => $tel,
    ":email" => $email
]);
// voir dans la BDD si les patients ont bien été rajoutés


// Rediriger vers une page liste patients. Puis sur cette page récupérer avec SELECT * FROM patients.
header("Location: ../public/liste-patients.php");
exit();
?>