<?php require_once "../utils/db_connect.php"; 



// Partie sécuritée
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header("Location: ../public/ajout-rendezvous.php?error=bad-method");
    exit();
}
if (!isset($_POST['datehour']) || !isset($_POST['patient'])) {
    header("Location: ../public/ajout-rendezvous.php?error=missing-value");
    exit();
}
if (empty($_POST['datehour']) || empty($_POST['patient'])) {
    header("Location: ../public/ajout-rendezvous.php?error=value-empty");
    exit();
}


// Input sanitization
$datehour = htmlspecialchars(trim($_POST['datehour']));
$patient = htmlspecialchars(trim($_POST['patient']));


// var_dump($datehour, $patient);
// die();



$request = $db->prepare("INSERT INTO appointments(datehour, patient_id) VALUE (:datehour, :patient)");
$request->execute([
    ":datehour" => $datehour,
    ":patient" => $patient
]);


header("Location: ../public/liste-rendezvous.php");
exit();


?>
