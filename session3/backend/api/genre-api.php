
<?php

require_once __DIR__ . '/../classes/Genre.php';
require_once __DIR__ . '/../classes/GestionGenre.php';

$gestion = new GestionGenre();

$method = $_SERVER['REQUEST_METHOD'];

// 1. GET : Lister les genres
if ($method === 'GET') {
    echo json_encode(
        $gestion->lister(),
        JSON_UNESCAPED_UNICODE
    );
    exit;
}

// 2. POST : Ajouter un genre
if ($method === 'POST') {

    // Lire les données envoyées par fetch()
    $contenu = file_get_contents('php://input');

    // Convertir JSON vers tableau PHP
    $data = json_decode($contenu, true);

    // Vérifier les données reçues
    if (
        !is_array($data) ||
        !isset($data['nom'], $data['description']) ||
        !is_string($data['nom']) ||
        !is_string($data['description']) ||
        trim($data['nom']) === '' ||
        trim($data['description']) === ''
    ) {
        http_response_code(400);

        echo json_encode([
            'success' => false,
            'message' => 'Nom et description obligatoires'
        ]);

        exit;
    }

    // Créer un objet Genre
    $genre = new Genre(
        trim($data['nom']),
        trim($data['description'])
    );

    // Envoyer l'objet à GestionGenre
    $succes = $gestion->ajouter($genre);

    // Envoyer la réponse au frontend
    if ($succes) {
        echo json_encode([
            'success' => true,
            'message' => 'Genre ajouté avec succès'
        ]);
    } else {
        http_response_code(500);

        echo json_encode([
            'success' => false,
            'message' => "Erreur lors de l'ajout du genre"
        ]);
    }

    exit;
}

// 3. Autres méthodes HTTP non autorisées
http_response_code(405);

echo json_encode([
    'success' => false,
    'message' => 'Méthode HTTP non autorisée'
]);
