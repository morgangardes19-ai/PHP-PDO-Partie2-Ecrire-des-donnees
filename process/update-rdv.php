<?php  
require_once "../utils/db_connect.php";

// var_dump($_POST);
// die();

// SECURITE EN POST car formulaire method="post"
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header("Location: ../public/update-rdv.php?error=bad-method");
    exit();
}
if (!isset($_POST['date']) || !isset($_POST['id'])) {
    header("Location: ../public/update-rdv.php?error=bad-method");
    exit();
}
if (empty($_POST['date']) || empty($_POST['id'])) {
    header("Location: ../public/update-rdv.php?error=bad-method");
    exit();
}

// Input sanitization
$date = htmlspecialchars(trim($_POST['date']));
$id = htmlspecialchars(trim($_POST['id']));

$request = $db->prepare("UPDATE appointments SET datehour = :dateRdv WHERE appointments.id = :id");
$success = $request->execute([
    ":dateRdv" => $date,
    ":id" => $id
]);
?>

<?php header("Location: ../public/liste-rendezvous.php");
exit(); ?>