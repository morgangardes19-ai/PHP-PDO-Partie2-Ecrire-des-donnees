<?php
require_once "../utils/db_connect.php";

// SECURISER GET ID PUIS NETTOYER
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $update = htmlspecialchars(trim($_GET['id']));
}

// ADAPTER LA REQUETE
$request = $db->prepare("SELECT patients.id FROM patients WHERE patients.id = :nom");
$request->execute([
":nom" => $update
]);

$clientUnique = $request->fetch(PDO::FETCH_ASSOC);
var_dump($clientUnique);
?>

<?php require_once "../_partials/_head.php" ?>

<!-- FAIRE LA PAGE ICI ENTRE HEAD ET FOOTER -->

<?php require_once "../_partials/_footer.php" ?>