<?php

class Vehicle
{
    private string $file;

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    // Read
    public function getAll(): array
    {
        $data = file_get_contents($this->file);

        return json_decode($data, true);
    }

    // Create
    public function add(array $vehicle): bool
    {
        $vehicles = $this->getAll();

        $vehicles[] = $vehicle;

        return file_put_contents(
            $this->file,
            json_encode($vehicles, JSON_PRETTY_PRINT)
        ) !== false;
    }
}