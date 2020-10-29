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

function includeIdFromDb($id){
    $bdd= connectToDb();
    $response = $bdd->prepare("SELECT id FROM products WHERE id ='" . $id . "';");
    $response->execute();
    $donnees = $response->fetch();
    print($donnees['id']);
}

function filterItems() {
    if(!empty($_POST['search_input'])) {

        $bdd = connectToDb();
        $search = strtolower($_POST['search_input']);
        $sql = "SELECT * FROM products WHERE LOWER(CONCAT(id, name, description, picture, price, category_id)) LIKE '%$search%'";
        $response = $bdd->prepare($sql);
        $response->execute();
        $array = array();
        echo "<div class='grid-container'>";
        foreach ($response->fetchAll() as $a) {
            array_push($array, $a['id']);
        }
        foreach ($array as $a) {

            echo "<div class=grid-item1 id=" .  $a . ">
            <img src=". (includeImgFromDb($a)). " class='image' alt='Coombes>
                <div class='description'>
                    <div class='info-container'>
                        <div class='info'>
                            <p class='line1-text' ><strong> ". includeNameFromDb($a). "</strong></p>
                 
                        </div>
                        <img class='start' src='../images/constant/Star - On.png' alt='Rating'>
                        <img class='start' src='../images/constant/Star - On.png' alt='Rating'>
                        <img class='start' src='../images/constant/Star - On.png' alt='Rating'>
                        <img class='start' src='../images/constant/Star - On.png' alt='Rating'>
                        <img class='start' src='../images/constant/Star.png' alt='Rating'>
                    </div>

                    <div class='buy'>
                        <div class='price'>
                          
                        </div>
                        <img src='../images/constant/Cart Button.png' class='img-cart' alt='Add item to cart'>
                    </div>
                </div>";
        }
        echo "</div>";
    }
    else {
        // $response = $bdd->prepare("SELECT * FROM products");
        // $response->execute();
        // printTable($response, $arrayProducts, "product");
    }
}
?>