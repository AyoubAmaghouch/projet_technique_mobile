<?php
class vehicles 
{
    private string $file ;
    public function __construct(string $file)
{
$this ->file = $file;
}

public function getall() : array 
{
$data = file_get_contents($this ->file);
return json_decode($data,true);
}
 
public function add (array $vehicle):bool
{
    $vehicles = $this ->getall();
    $vehicles[]  = $vehicle;
    return file_put_contents(
        $this -> file,
        json_encode($vehicles , JSON_PRETTY_PRINT)
    )!== false;
}
};







