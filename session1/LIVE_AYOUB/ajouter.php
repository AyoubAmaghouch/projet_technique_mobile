<?php
require_once "dbconfig.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nom = $_POST["nom"];
    $modele = $_POST["modele"];
    $est_diesel = $_POST["est_diesel"];
    $id_dealer = $_POST["id_dealer"];
    $id_vehicle_type = $_POST["id_vehicle_type"];

    $sql = "INSERT INTO vehicle 
            (nom, modele, est_diesel, id_dealer, id_vehicle_type)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $nom,
        $modele,
        $est_diesel,
        $id_dealer,
        $id_vehicle_type
    ]);
    header("Location: index.php");
    exit;
}
$stmtDealer = $pdo->query("SELECT id_dealer, nom FROM dealer");
$dealers = $stmtDealer->fetchAll(PDO::FETCH_ASSOC);
$stmtType = $pdo->query("SELECT id_vehicle_type, libelle FROM vehicle_type");
$vehicleTypes = $stmtType->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une voiture</title>
</head>
<body>

    <h1>Ajouter une nouvelle voiture</h1>

    <form method="POST">

        <label>Nom de la voiture</label>
        <input type="text" name="nom" required>

        <br><br>

        <label>Modèle</label>
        <input type="text" name="modele" required>

        <br><br>

        <label>Diesel ?</label>
        <select name="est_diesel" required>
            <option value="1">Oui</option>
            <option value="0">Non</option>
        </select>

        <br><br>

        <label>Dealer</label>
        <select name="id_dealer" required>
            <option value="">Sélectionnez un dealer</option>

            <?php foreach ($dealers as $dealer): ?>
                <option value="<?= $dealer['id_dealer'] ?>">
                    <?= htmlspecialchars($dealer['nom']) ?>
                </option>
            <?php endforeach; ?>

        </select>

        <br><br>

        <label>Type de véhicule</label>
        <select name="id_vehicle_type" required>
            <option value="">Sélectionnez un type</option>

            <?php foreach ($vehicleTypes as $type): ?>
                <option value="<?= $type['id_vehicle_type'] ?>">
                    <?= htmlspecialchars($type['libelle']) ?>
                </option>
            <?php endforeach; ?>

        </select>

        <br><br>

        <button type="submit">Ajouter</button>

    </form>

</body>
</html>