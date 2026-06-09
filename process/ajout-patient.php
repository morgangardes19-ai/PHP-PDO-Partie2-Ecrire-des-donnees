<?php 
session_start();
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$birthDate = $_POST['date'];
$tel = $_POST['telephone'];
$email = $_POST['email'];
// var_dump($nom, $prenom,$birthDate, $tel, $email);

$request = $db->prepare("INSERT INTO patients (lastname, firstname, birthdate, phone, mail) VALUES (:nom, :prenom, :birthDate, :tel, :email");
$request->execute([
    ":nom" => $nom,
    ":prenom" => $prenom,
    ":birthDate" => $birthDate,
    ":tel" => $tel,
    ":email" => $email
])
?>