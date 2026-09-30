<?php

require_once "../classes/vehicles.php";

$vehicle = new Vehicle("../data/vehicles.json");

header("Content-Type: application/json");

$method = $_SERVER["REQUEST_METHOD"];

if ($method === "GET") {

    echo json_encode([
        "success" => true,
        "data" => $vehicle->getAll()
    ]);

} elseif ($method === "POST") {

    $data = json_decode(file_get_contents("php://input"), true);

    if (!$data) {
        echo json_encode([
            "success" => false,
            "message" => "Données invalides"
        ]);
        exit;
    }

    $result = $vehicle->add($data);

    echo json_encode([
        "success" => $result,
        "message" => $result
            ? "Véhicule ajouté avec succès"
            : "Erreur lors de l'ajout"
    ]);

} else {

    echo json_encode([
        "success" => false,
        "message" => "Méthode non autorisée"
    ]);
}