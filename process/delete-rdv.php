<?php  
require_once "../utils/db_connect.php";

// if ($_SERVER['REQUEST_METHOD'] !== "POST") {
//     header("Location: ../public/liste-rendezvous.php?error=bad-method");
//     exit();
// }
// if (!isset($_POST['id'])) {
//     header("Location: ../public/liste-rendezvous.php?error=bad-method");
//     exit();
// }
// if (empty($_POST['id'])) {
//     header("Location: ../public/liste-rendezvous.php?error=bad-method");
//     exit();
// }

// Input sanitization
$id = htmlspecialchars(trim($_POST['id']));

$request = $db->prepare("DELETE FROM appointments WHERE id = :id");
$request->execute([
    ":id" => $id
]);
?>

<?php header("Location: ../public/liste-rendezvous.php");
exit(); ?>