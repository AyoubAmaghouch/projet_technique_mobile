<?php
require_once "../clasess/vehicles.php";
$vehicle = new vehicles ("../data/vehicles.json");
header("content-type : application/json");
$methode = $_SERVER["REQUEST_METHOD"];

if ($methode === "GET"){
    echo json_encode([
        "succes" => true,
        "data"=> $vehicle ->getall()
    ]); 
} elseif ($methode === "POST"){
    $data = json_decode(file_get_contents("php://input"),true);
    if (!$data){
        echo json_encode([
            "succes"=>false, "message"=>"donnés bein"
        ]);exit;
    }
    $result = $vehicle -> add ($data);
        echo json_encode([
            "succes" => $result , 
            "messag"=> $result ?"vehicle bien ajouter" : "erure"
        ]);

}else{
    echo json_encode([
"succes" => false,
"message"=>"méthode non autorisé "

    ]);
} 
?>                                                                      














