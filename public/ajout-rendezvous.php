<?php

require_once "../utils/db_connect.php";

// sécurité
// switch() sert à comparer une variable avec plusieurs cas possibles, c’est équivalent à faire plusieurs if
// sans break, PHP continuerait à lire les autres case
if (isset($_GET['error'])) { ?>
    <p class="text-red-500">
        <?php switch ($_GET['error']) {
            case 'bad-method':
                echo "Mauvaise méthode";
                break;
            case 'missing-value':
                echo "Valeur manquante";
                break;
            case 'value-empty':
                echo "Les champs ne peuvent pas être vide";
                break;
            default:
                echo "Erreur inconnue";
                break;
        }
        ?>
    </p>
<?php }
$request = $db->query("SELECT id, lastname, firstname FROM patients ORDER BY lastname ASC");
$patients = $request->fetchAll(PDO::FETCH_ASSOC); ?>


<?php require_once "../_partials/_head.php" ?>

<section class="flex justify-center items-center overflow-hidden rounded-xl bg-white shadow-lg w-screen h-70 border-2">
    <form action="../process/ajout-rendezvous.php" method="post" class="flex flex-col gap-4 border px-4 py-4">
        <label for="datehour" class="font-bold">Date et Heure du Rendez-vous :</label>
        <input type="datetime-local" name="datehour" id="datehour">

        <label for="patient" class="font-bold">Patient :</label>
        <select name="patient" id="patient">
            <?php foreach ($patients as $patient) { ?>
                <option value="<?= $patient['id'] ?>">
                    <?= strtoupper($patient['lastname']) ?> <?= $patient['firstname'] ?>
                </option>
            <?php } ?>

        </select>

        <button type="submit" class="border-2 rounded xs border-black bg-blue-500 text-white px-2">Créer le rendez-vous</button>
    </form>
</section>

<?php require_once "../_partials/_footer.php" ?>