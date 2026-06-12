<?php

require_once "../utils/db_connect.php";

$request = $db->query("SELECT id, lastname, firstname FROM patients ORDER BY lastname ASC");
$patients = $request->fetchAll(PDO::FETCH_ASSOC);

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
<?php } ?>


<?php require_once "../_partials/_head.php" ?>

<section class="flex justify-center items-center overflow-hidden rounded-xl bg-white shadow-lg w-screen h-70">
    <form action="../process/ajout-rendezvous.php" method="post" class="flex flex-col justify-start">
        <label for="datehour">Date et Heure du Rendez-vous :</label>
        <input type="datetime-local" name="datehour" id="datehour">
        
        <label for="patient">Patient :</label>
        <select name="patient" id="patient">
            <?php foreach ($patients as $patient) { ?>
                <option value="<?= $patient['id'] ?>">
                    <?= $patient['firstname'] ?> <?= $patient['lastname'] ?> 
                </option>
           <?php } ?>

        </select>

        <button type="submit">Créer le rendez-vous</button>
    </form>
</section>

<?php require_once "../_partials/_footer.php" ?>