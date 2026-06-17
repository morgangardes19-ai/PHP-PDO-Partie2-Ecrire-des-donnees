<?php  
require_once "../utils/db_connect.php";

if ($_SERVER['REQUEST_METHOD'] !== "GET") {
    header("Location: ../public/liste-rendezvous.php?error=bad-method");
    exit();
}
if (!isset($_GET['id'])) {
    header("Location: ../public/liste-rendezvous.php?error=missing-value");
    exit();
}
if (empty($_GET['id'])) {
    header("Location: ../public/liste-rendezvous.php?error=value-empty");
    exit();
}

// Input sanitization
$id = htmlspecialchars(trim($_GET['id']));

$request = $db->prepare("DELETE FROM appointments WHERE appointments.id = :id");
$request->execute([
    ":id" => $id
]);
?>

<?php header("Location: ../public/liste-rendezvous.php");
exit(); ?>