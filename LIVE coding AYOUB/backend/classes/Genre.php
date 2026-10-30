<?php


class Genre{
    private string $nom;
    private string $description;

    public function __construct(string $nom , string $description)
    {
       $this->nom=$nom;
       $this->description=$description;

    }


    public function getNom()
    {
        return $this->nom;
    }

    public function getDescription(): string{
        return $this->description;
    }

    public function setNom(string $nom): void{
        $this->nom = $nom;
    }

    public function setDescription(string $description): void{
        $this->description = $description;
    }

}