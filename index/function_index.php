<?php
function connectToDb(){
    try {
        $bdd = new PDO("mysql:host=127.0.0.1;dbname=my_shop", 'root', 'root');
        $bdd = new PDO("mysql:host=127.0.0.1;dbname=my_shop" . ';charset=utf8', "root", "root");
        return($bdd);
        //echo "Connection to DB successful" . PHP_EOL;
    } 
    catch (PDOException $e) {
        echo 'PDO ERROR: ' . $e->getMessage() . " storage in " . ERROR_LOG_FILE . ". Error connection to DB" . PHP_EOL;
        file_put_contents(ERROR_LOG_FILE, $e, FILE_APPEND);
    }
}

function includeImgFromDb($id){
    $bdd= connectToDb();
    $response = $bdd->prepare("SELECT picture FROM products WHERE id ='" . $id . "';");
    $response->execute();
    $donnees = $response->fetch();
    $picture_path = "../images/". $donnees['picture'];
    return($picture_path);
}

function includeNameFromDb($id){
    $bdd= connectToDb();
    $response = $bdd->prepare("SELECT name FROM products WHERE id ='" . $id . "';");
    $response->execute();
    $donnees = $response->fetch();
    $productName = $donnees['name'];
    return($productName);
}

function includeDescriptionFromDb($id){
    $bdd= connectToDb();
    $response = $bdd->prepare("SELECT description FROM products WHERE id ='" . $id . "';");
    $response->execute();
    $donnees = $response->fetch();
    $productDesc = $donnees['description'];
    print($donnees['description']);
}

function includePriceFromDb($id){
    $bdd= connectToDb();
    $response = $bdd->prepare("SELECT price FROM products WHERE id ='" . $id . "';");
    $response->execute();
    $donnees = $response->fetch();
    print($donnees['price']);
}
?>