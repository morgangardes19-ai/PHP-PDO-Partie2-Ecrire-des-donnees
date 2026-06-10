<?php
require_once "../utils/db_connect.php";

$request = $db->query("SELECT * FROM patients ORDER BY lastname ASC");
$patients = $request->fetchAll(PDO::FETCH_ASSOC);

// var_dump($patients);
?>

<?php require_once "../_partials/_head.php" ?>

<h1>Liste de patients</h1>
<ol>
    <?php foreach ($patients as $patient) { ?>
        <li><?= $patient['lastname'] . " " . $patient['firstname'] ?></li>
    <?php } ?><br>
    <?= "Le patient a bien été rajouté à la liste." ?>
</ol>

<div class = "flex flex-col items-center border-solid">
    <button><a href="../public/ajout-patient.php">Retourner à la création de patients</a></button>
</div>

<?php require_once "../_partials/_footer.php" ?>