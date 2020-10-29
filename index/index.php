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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <title>All Stars my shop</title>
</head>

<body>
    <!-- MENU -->
    <div class="wrapper_menu">
        <div class="left">
            <nav class="menu navbar navbar-expand-lg navbar-light bg-light">
                <ul class="navbar-nav mr-auto">
                    <img src="images/constant/Logo.png" class="logo">
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
                    <li class="nav-item"><a href="../authentication/logout.php" class="nav-link">SIGN OUT</a></li>
                    <img src="images/constant/burger.png" class="menu_mobile" />
                </ul>
            </nav>
        </div>
    </div>

    <!-- SEARCH BAR -->
    
    <div class="grid-search">
        <div class="grid-search1">
                <div class="sub_search">
                    <input type="text" id="search" class="search_bar" placeholder="Search bar"></input>
                </div> 
        </div>

        <div class="grid-search2">
            <div class="dropdown_search">
                <ul class="dropdown">
                    <li class="disable_best"><a href="#">Best match <img class="img_arrow2"
                                src="https://upload.wikimedia.org/wikipedia/commons/9/9d/Arrow-down.svg"
                                alt="arrow down"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- BODY -->
    <div class="big-container">
        <div class="grid-container">
            <div class="grid-item1">
                <div class=filter_section>
                    <p class="filter"> FILTER BY </p>

                    <ul id="myUL">
                        <li class="filters-ticket"><a href="#">Best match <img class="img_arrow"
                                    src="https://upload.wikimedia.org/wikipedia/commons/9/9d/Arrow-down.svg"
                                    alt="arrow down"></a>
                        </li>
                        <li class="filters-ticket"><a href="#">Filters <img class="img_arrow"
                                    src="https://upload.wikimedia.org/wikipedia/commons/9/9d/Arrow-down.svg"
                                    alt="arrow down"></a>
                        </li>
                        <li class="collection-ticket"><a href="#">Collection <img class="img_arrow"
                                    src="https://upload.wikimedia.org/wikipedia/commons/9/9d/Arrow-down.svg"
                                    alt="arrow down"></a>
                        </li>
                        <li class="color-ticket"><a href="#">Color <img class="img_arrow"
                                    src="https://upload.wikimedia.org/wikipedia/commons/9/9d/Arrow-down.svg"
                                    alt="arrow down"></a>
                        </li>
                        <li class="category-ticket"><a href="#">Category <img class="img_arrow"
                                    src="https://upload.wikimedia.org/wikipedia/commons/9/9d/Arrow-down.svg"
                                    alt="arrow down"></a>
                        </li>
                    </ul>

                    <div class="slidecontainer">
                        <label for="myRange" class="label_price">Price min</label>
                        <input type="range" min="1" max="100" value="50" class="slider" id="myRange">
                        <p class="min_price">$0</p>
                    </div>

                    <div class="slidecontainer2">
                        <label for="myRange2" class="label_price">Price max</label>
                        <input type="range" min="1" max="100" value="50" class="slider" id="myRange2">
                        <p class="max_price">$10,000+</p>
                    </div>
                </div>
            </div>

            <div class="grid-item2">
                <img src="images/furniture_p1/test1.jpg" class="image" alt="Coombes">

                <div class="description">
                    <div class="info-container">
                        <div class="info">
                            <p class="line1-text" ><strong>Coombes</strong></p>
                            <p class="info-text">LOUNGE</p>
                        </div>
                        <img class="start" src="images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="images/constant/Star.png" alt="Rating">
                    </div>

                    <div class="buy">
                        <div class="price">
                            <p class="line1-text">$2,600</p>
                        </div>
                        <img src="images/constant/Cart Button.png" class="img-cart" alt="Add item to cart">
                    </div>
                </div>
            </div>

            <div class="grid-item3">
                <img src="images/furniture_p1/test2.jpg" class="image" alt="Keeves Set">

                <div class="description">
                    <div class="info-container">
                        <div class="info">
                            <p class="line1-text" ><strong>Keeve Set</strong></p>
                            <p class="info-text">TABLE & CHAIRS</p>
                        </div>
                        <img class="start" src="images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="images/constant/Star.png" alt="Rating">
                    </div>

                    <div class="buy">
                        <div class="price">
                            <p class="line1-text">$590</p>
                        </div>
                        <img src="images/constant/Cart Button.png" class="img-cart" alt="Add item to cart">
                    </div>
                </div>
            </div>

            <div class="grid-item4">
                <img src="images/furniture_p1/test3.jpg" class="image" alt="Nillè">

                <div class="description">
                    <div class="info-container">
                        <div class="info">
                            <p class="line1-text"><strong>Nillè</strong></p>
                            <p class="info-text">ARMCHAIR</p>
                        </div>
                        <img class="start" src="images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="images/constant/Star.png" alt="Rating">
                    </div>

                    <div class="buy">
                        <div class="price">
                            <p class="line1-text">$950</p>
                        </div>
                        <img src="images/constant/Cart Button.png" class="img-cart" alt="Add item to cart">
                    </div>
                </div>
            </div>

            <div class="grid-item5">
                <img src="images/furniture_p1/test4.jpg" class="image" alt="Blanko">

                <div class="description">
                    <div class="info-container">
                        <div class="info">
                            <p class="line1-text"><strong>Blanko</strong></p>
                            <p class="info-text">SIDE TABLE</p>
                        </div>
                        <img class="start" src="images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="images/constant/Star.png" alt="Rating">
                    </div>

                    <div class="buy">
                        <div class="price">
                            <p>$90</p>
                        </div>
                        <img src="images/constant/Cart Button.png" class="img-cart" alt="Add item to cart">
                    </div>
                </div>
            </div>

            <div class="grid-item6">
                <img src="images/furniture_p1/test5.jpg" class="image" alt="Momo">

                <div class="description">
                    <div class="info-container">
                        <div class="info">
                            <p><strong>Momo</strong></p>
                            <p class="info-text">SHELVES</p>
                        </div>
                        <img class="start" src="images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="images/constant/Star.png" alt="Rating">
                    </div>

                    <div class="buy">
                        <div class="price">
                            <p>$890</p>
                        </div>
                        <img src="images/constant/Cart Button.png" class="img-cart" alt="Add item to cart">
                    </div>
                </div>
            </div>

            <div class="grid-item7">
                <img src="images/furniture_p1/test6.jpg" class="image" alt="Penemillè">

                <div class="description">
                    <div class="info-container">
                        <div class="info">
                            <p><strong>Penemillè</strong></p>
                            <p class="info-text">CHAIR</p>
                        </div>
                        <img class="start" src="images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="images/constant/Star.png" alt="Rating">
                    </div>

                    <div class="buy">
                        <div class="price">
                            <p>$120</p>
                        </div>
                        <img src="images/constant/Cart Button.png" class="img-cart" alt="Add item to cart">
                    </div>
                </div>
            </div>

            <div class="grid-item8">
                <img src="images/furniture_p1/test7.jpg" class="image" alt="Kappu">

                <div class="description">
                    <div class="info-container">
                        <div class="info">
                            <p><strong>Kappu</strong></p>
                            <p class="info-text">SHELVES</p>
                        </div>
                        <img class="start" src="images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="images/constant/Star - On.png" alt="Rating">
                        <img class="start" src="images/constant/Star.png" alt="Rating">
                    </div>

                    <div class="buy">
                        <div class="price">
                            <p>$420</p>
                        </div>
                        <img src="images/constant/Cart Button.png" class="img-cart" alt="Add item to cart">
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