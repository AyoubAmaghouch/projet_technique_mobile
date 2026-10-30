<?php

require_once __DIR__ . '/Genre.php';


class GestionGenre
{
    private static string $dataFile = __DIR__ . '/../data/genres.json';

    public function lister(): array{
        $contenu = file_get_contents(self::$dataFile);

        $genres = json_decode($contenu, true);
        return $genres;
    }

    public function ajouter(Genre $genre): bool
    {
        $genres = $this->lister();

        
        $newId = 1;

        if (!empty($genres)) {
            $ids = array_column($genres, 'id');
                $newId = max($ids) + 1;
            }

            $genres[] = [
                'id' => $newId,
                'nom' => $genre->getNom(),
                'description' => $genre->getDescription()
            ];

         
            $nouveauContenu = json_encode(
                $genres,
            );
 // 5. Vérifier la conversion JSON
            if ($nouveauContenu === false) {
                return false;
            }

            
            return file_put_contents(
                self::$dataFile,
                $nouveauContenu
                
            ) ;


    }
}













