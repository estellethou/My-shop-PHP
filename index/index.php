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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="author" content="All Stars" />
    <meta name="description"
        content="All Stars my shop is a template of a concept store using HTML, CSS and MySQL only. You can display products and categories, 
        sign-in and sign-up, save users in database, use an admin page to manage your database. Here is an example of a concept store displaying 
        all fashion and timeless shoes ever created since 1920. " />
    <link href="index.css" rel="stylesheet" />
    <link href="mobile.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&display=swap" rel="stylesheet">
        <integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <title>All Stars my shop</title>
</head>

<body>
    <!-- MENU -->

    <!-- show admin tools if admin -->
    <?php
    if($_COOKIE['admin']) {
    ?>
    <style type="text/css">#adminTools {
        display: flex;
    <?php } ?></style>
    
    
}
    <div class="wrapper_menu">
        <div class="left">
            <nav class="menu navbar navbar-expand-lg navbar-light bg-light">
                <ul class="navbar-nav mr-auto">
                    <img src="../images/star.png" class="logo">
                    <li class="nav-item disable"><a href="#" class="nav-link">HOME</a></li>
                    <li class="nav-item disable"><a href="#" class="nav-link">SHOP</a></li>
                    <li class="nav-item disable"><a href="#" class="nav-link">MAGAZINE</a></li>
                </ul>
            </nav>
        </div>

        <div class="right">
            <nav class="menu navbar navbar-expand-lg navbar-light bg-light">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a href="#" class="nav-link cart"></a></li>
                    <li class="nav-item"><a href="../admin/admin.php" class="nav-link" id="adminTools">ADMIN TOOLS</a></li>
                    <li class="nav-item"><a href="../authentication/logout.php" class="nav-link">SIGN OUT</a></li>
                    <img src="../images/constant/burger.png" class="menu_mobile" />
                </ul>
            </nav>
        </div>
    </div>

    <!-- SEARCH BAR -->
    
    <div class="grid-search">
        <div class="grid-search1">
                <div class="search">
                    <input type="text" id="search" class="search_bar" placeholder="Search bar"></input>
                </div> 
        </div>
    </div>

    <!-- BODY -->
    <div class="big-container">
        <div class="grid-container">
            <div class="grid-item1">
            <img src="<?php echo(includeImgFromDb(1));?>" class="image" alt="Coombes">
                <div class="description">
                    <div class="info-container">
                        <div class="info">
                            <p class="line1-text" ><strong><?php echo(includeNameFromDb(1));?></strong></p>
                            <p class="info-text"><?php includeDescriptionFromDb(1);?></p>
                        </div>
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star.png" alt="Rating">
                    </div>

                    <div class="buy">
                        <div class="price">
                            <p class="line1-text">$<?php includePriceFromDb(1);?></p>
                        </div>
                        <img src="../images/constant/Cart Button.png" class="img-cart" alt="Add item to cart">
                    </div>
                </div>
            </div>

            <div class="grid-item2">
                <img src="<?php echo(includeImgFromDb(39));?>" class="image" alt="Coombes">

                <div class="description">
                    <div class="info-container">
                        <div class="info">
                            <p class="line1-text" ><strong><?php echo(includeNameFromDb(2));?></strong></p>
                            <p class="info-text"><?php includeDescriptionFromDb(2);?></p>
                        </div>
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star.png" alt="Rating">
                    </div>

                    <div class="buy">
                        <div class="price">
                            <p class="line1-text">$<?php includePriceFromDb(39);?></p>
                        </div>
                        <img src="../images/constant/Cart Button.png" class="img-cart" alt="Add item to cart">
                    </div>
                </div>
            </div>

            <div class="grid-item3">
                <img src="<?php echo(includeImgFromDb(3));?>" class="image" alt="Keeves Set">

                <div class="description">
                    <div class="info-container">
                        <div class="info">
                            <p class="line1-text" ><strong><?php echo(includeNameFromDb(3));?></strong></p>
                            <p class="info-text"><?php includeDescriptionFromDb(3);?></p>
                        </div>
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star.png" alt="Rating">
                    </div>

                    <div class="buy">
                        <div class="price">
                            <p class="line1-text">$<?php includePriceFromDb(3);?></p>
                        </div>
                        <img src="../images/constant/Cart Button.png" class="img-cart" alt="Add item to cart">
                    </div>
                </div>
            </div>

            <div class="grid-item4">
                <img src="<?php echo(includeImgFromDb(4));?>" class="image" alt="Nillè">

                <div class="description">
                    <div class="info-container">
                        <div class="info">
                            <p class="line1-text"><strong><?php echo(includeNameFromDb(4));?></strong></p>
                            <p class="info-text"><?php includeDescriptionFromDb(4);?></p>
                        </div>
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star.png" alt="Rating">
                    </div>

                    <div class="buy">
                        <div class="price">
                            <p class="line1-text">$<?php includePriceFromDb(4);?></p>
                        </div>
                        <img src="../images/constant/Cart Button.png" class="img-cart" alt="Add item to cart">
                    </div>
                </div>
            </div>

            <div class="grid-item5">
                <img src="<?php echo(includeImgFromDb(6));?>" class="image" alt="Blanko">

                <div class="description">
                    <div class="info-container">
                        <div class="info">
                            <p class="line1-text"><strong><?php echo(includeNameFromDb(6));?></strong></p>
                            <p class="info-text"><?php includeDescriptionFromDb(6);?></p>
                        </div>
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star.png" alt="Rating">
                    </div>

                    <div class="buy">
                        <div class="price">
                            <p>$<?php includePriceFromDb(6);?></p>
                        </div>
                        <img src="../images/constant/Cart Button.png" class="img-cart" alt="Add item to cart">
                    </div>
                </div>
            </div>

            <div class="grid-item6">
                <img src="<?php echo(includeImgFromDb(2));?>" class="image" alt="Momo">

                <div class="description">
                    <div class="info-container">
                        <div class="info">
                            <p><strong><?php echo(includeNameFromDb(39));?></strong></p>
                            <p class="info-text">S<?php includeDescriptionFromDb(39);?></p>
                        </div>
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star.png" alt="Rating">
                    </div>

                    <div class="buy">
                        <div class="price">
                            <p>$<?php includePriceFromDb(2);?></p>
                        </div>
                        <img src="../images/constant/Cart Button.png" class="img-cart" alt="Add item to cart">
                    </div>
                </div>
            </div>

            <div class="grid-item7">
                <img src="<?php echo(includeImgFromDb(42));?>" class="image" alt="Penemillè">

                <div class="description">
                    <div class="info-container">
                        <div class="info">
                            <p><strong><?php echo(includeNameFromDb(42));?></strong></p>
                            <p class="info-text"><?php includeDescriptionFromDb(42);?></p>
                        </div>
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star.png" alt="Rating">
                    </div>

                    <div class="buy">
                        <div class="price">
                            <p>$<?php includePriceFromDb(42);?></p>
                        </div>
                        <img src="../images/constant/Cart Button.png" class="img-cart" alt="Add item to cart">
                    </div>
                </div>
            </div>

            <div class="grid-item8">
                <img src="<?php echo(includeImgFromDb(43));?>" class="image" alt="Kappu">

                <div class="description">
                    <div class="info-container">
                        <div class="info">
                            <p><strong><?php echo(includeNameFromDb(43));?></strong></p>
                            <p class="info-text"><?php includeDescriptionFromDb(43);?></p>
                        </div>
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="../images/constant/Star.png" alt="Rating">
                    </div>

                    <div class="buy">
                        <div class="price">
                            <p>$<?php includePriceFromDb(43);?></p>
                        </div>
                        <img src="../images/constant/Cart Button.png" class="img-cart" alt="Add item to cart">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PAGINATION -->
    <footer>
        <div class="pagination">
            <a class="p1 active" href="#">1</a>
            <a class="p2" href="#">2</a>
            <a class="p3" href="#">3</a>
            <a class="p4" href="#">4</a>
            <a class="p5" href="#">5</a>
            <a class="p6" href="#">6</a>
            <a class="p7" href="#">7</a>
            <a class="p8" href="#">8</a>
            <a class="p9" href="#">9</a>
            <a class="p10" href="#">10</a>
            <a id="page_arrow" href="#">&gt;</a>
        </div>
    </footer>
    
</body>
</html>