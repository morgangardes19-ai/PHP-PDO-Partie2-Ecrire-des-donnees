<?php  
require_once "../utils/db_connect.php";

// var_dump($_POST);
// die();

// SECURITE EN POST car formulaire method="post"
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header("Location: ../public/update-patient.php?error=bad-method");
    exit();
}
if (!isset($_POST['nom']) || !isset($_POST['prenom']) || !isset($_POST['date']) || !isset($_POST['telephone']) || !isset($_POST['email']) || !isset($_POST['id'])) {
    header("Location: ../public/update-patient.php?error=bad-method");
    exit();
}
// empty vérifie que " " -> vide, que null -> vide, que 0 -> vide
if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['date']) || empty($_POST['telephone']) || empty($_POST['email']) || empty($_POST['id'])) {
    header("Location: ../public/update-patient.php?error=bad-method");
    exit();
}

// Input sanitization
// trim : surpprime les espaces -> "Morgan " -> "Morgan"
// htmlspecialchars() : transforme les caractères HTML <script> qui devient : &lt;script&gt;
$nom = htmlspecialchars(trim($_POST['nom']));
$prenom = htmlspecialchars(trim($_POST['prenom']));
$birthDate = htmlspecialchars(trim($_POST['date']));
$tel = htmlspecialchars(trim($_POST['telephone']));
$email = htmlspecialchars(trim($_POST['email']));
$id = htmlspecialchars(trim($_POST['id']));

$request = $db->prepare("UPDATE patients SET lastname = :nom, firstname = :prenom, birthdate = :birthDate, phone = :tel, mail = :email WHERE patients.id = :id");
$success = $request->execute([
    ":nom" => $nom,
    ":prenom" => $prenom,
    ":birthDate" => $birthDate,
    ":tel" => $tel,
    ":email" => $email,
    ":id" => $id
]);
?>

<?php require_once "../_partials/_head.php" ?>
<?php header("Location: ../public/liste-patients.php");
exit(); ?>
<?php require_once "../_partials/_footer.php" ?>