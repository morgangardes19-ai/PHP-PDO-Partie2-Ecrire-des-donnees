<?php require_once "../utils/db_connect.php";

// var_dump($db);
?>

<?php
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'bad-method':
            echo "Mauvaise méthode";
            break;
    }
}
?>
<!-- PARTIE SECURITE  -->
<?php
require_once "../utils/db_connect.php";

if ($_SERVER['REQUEST_METHOD'] !== "GET") {
    header("Location: ./liste-patient.php?error=bad-method");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: ./liste-patient.php?error=missing-value");
    exit();
}

if (empty($_GET['id'])) {
    header("Location: ./liste-patient.php?error=value-empty");
    exit();
}
?>

<?php
$patientId = htmlspecialchars(trim($_GET['id']));
$request = $db->prepare("SELECT * FROM patients WHERE patients.id = :id");
$request->execute([
    ":id" => $patientId
]);

$clientUnique = $request->fetch(PDO::FETCH_ASSOC);
var_dump($clientUnique);
?>

<?php require_once "../_partials/_head.php" ?>

<section class="flex justify-center overflow-hidden rounded-xl bg-white shadow-lg">

    <form action="../process/update-patient.php" method="post">
        <table>
            <thead>
                <tr>
                    <th>Informations du patient</th>
                    <th>Champs à modifier</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td><label for="nom" class="bg-blue-900 text-white rounded-xl px-16 py-32">Nom du patient :</label></td>
                    <td><input type="text" name="nom" id="nom" class="border border-black rounded-xl" value="<?= $clientUnique['lastname'] ?>"></td>
                </tr>
                <tr>
                    <td><label for="prenom" class="bg-blue-900 text-white rounded-xl px-16 py-32">Prénom du patient :</label></td>
                    <td><input type="text" name="prenom" id="prenom" class="border border-black rounded-xl" value="<?= $clientUnique['firstname'] ?>"></td>
                </tr>
                <tr>
                    <td><label for="date" class="bg-blue-900 text-white rounded-xl px-16 py-32">Date de naissance</td>
                    <td><input type="date" name="date" id="date" class="border border-black rounded-xl" value="<?= $clientUnique['birthdate'] ?>"></td>
                </tr>
                <tr>
                    <td><label for="telephone" class="bg-blue-900 text-white rounded-xl px-16 py-32">Numéro de téléphone</label></td>
                    <td><input type="tel" name="telephone" id="telephone" class="border border-black rounded-xl" value="<?= $clientUnique['phone'] ?>"></td>
                </tr>
                <tr>
                    <td><label for="email" class="bg-blue-900 text-white rounded-xl px-16 py-32">Email</label></td>
                    <td><input type="email" name="email" id="email" class="border border-black rounded-xl" value="<?= $clientUnique['mail'] ?>"></td>
                </tr>
            </tbody>
            <tr>
                <input type="hidden" name="id" id="id" class="border border-black rounded-xl" value="<?= $clientUnique['id'] ?>">

                <td><button type="submit" class="border border-black">Modifier</button></td>
            </tr>
        </table>
    </form>
</section>

<?php require_once "../_partials/_footer.php" ?>