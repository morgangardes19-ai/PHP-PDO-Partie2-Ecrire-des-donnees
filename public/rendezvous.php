<?php 
require_once "../utils/db_connect.php";

// ETAPEDE SECURITE

// SANITI
$id = htmlspecialchars(trim($_GET["id"]));

$request = $db->prepare("SELECT * FROM patients JOIN appointments ON patients.id = appointments.patient_id WHERE appointments.id = :id");
$request->execute([
    ":id"=> $id
]);
$detailRdv = $request->fetch(PDO::FETCH_ASSOC);

var_dump($detailRdv);
?>