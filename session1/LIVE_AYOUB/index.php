<?php
require_once "dbconfig.php";
$sql = "
    SELECT 
        vehicle.id_vehicle,
        vehicle.nom,
        vehicle.modele,
        vehicle.est_diesel,
        dealer.nom AS dealer_nom,
        vehicle_type.libelle AS type_nom
    FROM vehicle
    INNER JOIN dealer
        ON vehicle.id_dealer = dealer.id_dealer
    INNER JOIN vehicle_type
        ON vehicle.id_vehicle_type = vehicle_type.id_vehicle_type
";

$stmt = $pdo->query($sql);
$vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des véhicules</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Gestion des véhicules</h1>
    <a href="ajouter.php">+ Ajouter une nouvelle voiture</a>

    <br><br>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Modèle</th>
                <th>Diesel</th>
                <th>Dealer</th>
                <th>Type</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($vehicles as $vehicle): ?>

                <tr>
                    <td>
                        <?= htmlspecialchars($vehicle['nom']) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($vehicle['modele']) ?>
                    </td>

                    <td>
                        <?= $vehicle['est_diesel'] ? 'Oui' : 'Non' ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($vehicle['dealer_nom']) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($vehicle['type_nom']) ?>
                    </td>
                </tr>

            <?php endforeach; ?>

        </tbody>
    </table>

</body>
</html>