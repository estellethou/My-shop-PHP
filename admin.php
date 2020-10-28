<?php
if (!$_COOKIE['admin']) {
    header("Location: index.php");
   }

interface Printing{
    public function printTable();
}

function printTable ($response, $tableColumns, $objectType) {
    echo "<table class='table table-striped' id='usersTable'><tr><thead class='thead-dark'>";
    foreach ($tableColumns as $a) {
        echo "<th scope='col'>$a</th>";
    }  
    echo "<th scope='col'>Edit $objectType</th>";
    echo "<th scope='col'>Delete $objectType</th>";
    echo "</thead></tr>";
    echo "<tbody>";
    while($donnees = $response->fetch())
    {
        echo "<form method=post>";
        echo "<tr>";
        foreach ($tableColumns as $a) {
            $value = $donnees[strtolower($a)];
            echo "<td><input value='$value' name = " . strtolower($a) ."></td>";
        }  
        echo "<td> <input type = 'submit' name ='edit_$objectType' class='add_category btn btn-primary' value='Edit $objectType'/> </td>";
        echo "<td> <input type = 'submit' name ='delete_$objectType' class='add_category btn btn-danger' value='Delete $objectType'/> </td>";
        echo "</tr>";
        echo "</form>";
    }
    echo "</tbody>";
    echo "</table>";
}

class Product {
    const ERROR_LOG_FILE = "errors.log";
    private $name;
    private $description;
    private $picture;
    private $price;
    private $category_id;
    
    public function __construct($name, $description, $picture, $price, $category_id){
        $this->name = $name;
        $this->description = $description;
        $this->picture = $picture;
        $this->price = $price;
        $this->category_id = $category_id;
        $this->insertProductIntoDb();
    }

    public function insertProductIntoDb(){
        $bdd = connectToDb();

        $response = $bdd->prepare("INSERT INTO products(name, description, picture, price, category_id) 
                                  VALUES (?, ?, ?, ?, ?);");
        $response->bindParam(1, $this->name, PDO::PARAM_STR);
        $response->bindParam(2, $this->description, PDO::PARAM_STR);
        $response->bindParam(3, $this->picture, PDO::PARAM_STR);
        $response->bindParam(4, intval($this->price), PDO::PARAM_INT);
        $response->bindParam(5, intval($this->category_id), PDO::PARAM_INT);
        $response->execute();
    }
} 

class Category {
    const ERROR_LOG_FILE = "errors.log";
    private $name_category;
    private $parent_id;
    
    public function __construct($name_category, $parent_id){
        $this->name_category = $name_category;
        $this->parent_id = $parent_id;
        $this->insertCategoryIntoDb();
    }

    public function insertCategoryIntoDb(){
        $bdd = connectToDb();

        $response = $bdd->prepare("INSERT INTO categories(name, parent_id) 
                                  VALUES (?, ?);");
        $response->bindParam(1, $this->name_category, PDO::PARAM_STR);
        $response->bindParam(2, $this->parent_id, PDO::PARAM_INT);
        $response->execute();
    } 
} 

class User {
    const ERROR_LOG_FILE = "errors.log";
    private $username;
    private $password;
    private $email;
    private $admin;
    
    public function __construct($username, $password, $email, $admin){
        $this->username = $username;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->email = $email;
        $this->admin = $admin; 
        $this->insertUserIntoDb();
    }

    public function insertUserIntoDb(){
        $bdd = connectToDb();
        $query = $bdd->prepare("SELECT email FROM users WHERE email ='" . $_POST['email'] . "';");
        $query->execute();
        $arrayUsers = $query->fetchAll();
        if ($arrayUsers == null) {
            $response = $bdd->prepare("INSERT INTO users(username, password, email, admin, created_at) 
                                  VALUES (?, ?, ?, ?, NOW());");
            $response->bindParam(1, $this->username, PDO::PARAM_STR);
            $response->bindParam(3, $this->email, PDO::PARAM_STR);
            $response->bindParam(2, $this->password, PDO::PARAM_STR);
            $response->bindParam(4, $this->admin, PDO::PARAM_INT);
            $response->execute();
        }
    }
} 

function deleteUserIntoDb(){
        $bdd = connectToDb();
        $response = $bdd->prepare("DELETE FROM users WHERE id='" . $_POST['id'] . "';");
        $response->execute();
        $response = $bdd->prepare("SELECT * FROM users");
        $response->execute();
        echo "<meta http-equiv='refresh' content='0'>";
}

function editUserIntoDb(){
    if (isset($_POST['edit_user'])){
        $bdd = connectToDb();
        $response = $bdd->prepare("UPDATE users 
        SET username='" . $_POST['username'] . "', 
        password='" . $_POST['password'] . "',
        email='" . $_POST['email'] . "',
        admin='" . $_POST['admin'] . "' WHERE id='" . $_POST['id'] . "';");
        $response->execute();
        $response = $bdd->prepare("SELECT * FROM users");
        $response->execute();
        echo "<meta http-equiv='refresh' content='0'>";
    }
}

function deleteProductIntoDb(){
        $bdd = connectToDb();
        $response = $bdd->prepare("DELETE FROM products WHERE id='" . $_POST['id'] . "';");
        $response->execute();
        $response = $bdd->prepare("SELECT * FROM products");
        $response->execute();
        echo "<meta http-equiv='refresh' content='0'>";
}

function deleteCategoryIntoDb(){
        $bdd = connectToDb();
        $response = $bdd->prepare("DELETE FROM categories WHERE id='" . $_POST['id'] . "';");
        $response->execute();
        $response = $bdd->prepare("SELECT * FROM categories");
        $response->execute();
        echo "<meta http-equiv='refresh' content='0'>";
}

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

$bdd = connectToDb();


if (isset($_POST['add_user']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email']) && isset($_POST['admin'])){
    new User($_POST['username'], $_POST['password'], $_POST['email'], $_POST['admin']);    
}

if (isset($_POST['add_product']) && !empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['picture']) && !empty($_POST['price']) && !empty($_POST['category_id'])) {
    new Product($_POST['name'], $_POST['description'], $_POST['picture'], $_POST['price'], $_POST['category_id']);
}

if (isset($_POST['add_category']) && !empty($_POST['name_category']) && !empty($_POST['parent_id'])) {
    new Category($_POST['name_category'], $_POST['parent_id']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="author" content="All Stars" />
    <meta name="description"
        content="All stars is a concept store of furnitures for your appartement. You will find amazing design furnitures for your living room, your kitchen, your batchroom and your bedroom." />
    <link href="style_admin.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&display=swap" rel="stylesheet">
    <title>All stars - Concept Store</title>
</head>

<body>
<h1> Administration page </h1>
    <h2> Add Users </h2>   
        <form method="post">
            <div class="form-group">
                    <label for="username">Username: </label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="username"> 
            </div>

            <div class="form-group">
                    <label for="password">Password: </label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="password"> 
            </div>

            <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
            </div>

            <div class="form-group">
                <label for="admin">1 for admin 0 otherwise </label>
                <select class="form-control" id="admin" name="admin">
                <option>0</option>
                <option>1</option>
                </select>
            </div>
            <div class="form-group align-self-end">
                <input type="submit" value="Add User" name="add_user" class="btn btn-primary add_user"/>
            </div>
        </form>
        <form method="post">
            <div class="container search">
                <input class="form-control mr-sm-2" type="search" name = "input_search_users" placeholder="Search Users" aria-label="Search">
                <button class="btn btn-primary" type="submit" name="search_users">Filter Users</button>
            </div>
        </form>
<?php 

$arrayUsers = array("Id", "Username", "Password", "Email", "Admin", "Created_at");
if(isset($_POST['search_users'])) {
    $search = strtolower($_POST['input_search_users']);
    $sql = "SELECT * FROM users WHERE LOWER(CONCAT(id, username, password, email, admin)) LIKE '%$search%'";
    $response = $bdd->prepare($sql);
    $response->execute();
    printTable($response, $arrayUsers, "user");
}
else {
    $response = $bdd->prepare("SELECT * FROM users");
    $response->execute();
    printTable($response, $arrayUsers, "user");
}
if (isset($_POST['delete_user'])){
    deleteUserIntoDb();
}
?>

<h2> Add Products </h2>   
        <form method="post">
            <div class="form-group">
                    <label for="username">Name: </label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="name"> 
            </div>
            <div class="form-group">
                    <label for="description">Description: </label>
                    <input type="test" class="form-control" id="description" name="description" placeholder="description">
            </div>
            <div class="form-group">
                <label for="picture">Picture: </label>
                <input type="file" class="form-control-file " id="picture" name="picture">
            </div>
            <div class="form-group">
                <label for="price">Price: </label>
                <input type="text" class="form-control" id="price" name="price">
            </div>

            <div class="form-group">
                <label for="category_id">Category Id: </label>
                <input type="number" class="form-control" id="category_id" name="category_id">
            </div>
            <div class="form-group align-self-end">
                    <input type = "submit" name ="add_product" class="add_product btn btn-primary" value="Add Product" /> 
            </div>
        </form>
        <form method="post">
            <div class="container search">
                <input class="form-control mr-sm-2" type="search" name = "input_search_products" placeholder="Search Products" aria-label="Search">
                <button class="btn btn-primary" type="submit" name="search_products">Filter Products</button>
            </div>
        </form>
<?php 
$arrayProducts = array("Id", "Name", "Description", "Picture", "Price", "Category id");

if(isset($_POST['search_products'])) {
    $search = strtolower($_POST['input_search_products']);
    $sql = "SELECT * FROM users WHERE LOWER(CONCAT(id, name, description, picture, price, category_id)) LIKE '%$search%'";
    $response = $bdd->prepare($sql);
    $response->execute();
    printTable($response, $arrayProducts, "product");
}
else {
    $response = $bdd->prepare("SELECT * FROM products");
    $response->execute();
    printTable($response, $arrayProducts, "product");
}
if (isset($_POST['delete_product'])) {
    deleteProductIntoDb();
}
?>

<h2> Add Categories </h2>   
        <form method="post">
            <div class="form-group">
                    <label for="name_category">Name: </label>
                    <input type="text" class="form-control" id="name_category" name="name_category" placeholder="name_category">
            </div>
            <div class="form-group">
                    <label for="parent_id">Parent Id (Optional): </label>
                    <input type="number" class="form-control" id="parent_id" name="parent_id" placeholder="parent_id"> 
            </div>
            <div class="form-group align-self-end">
                    <input type = "submit" name ="add_category" class="add_category btn btn-primary" value="Add Category"/> 
            </div>
        </form>
        <form method="post">
            <div class="container search">
                <input class="form-control mr-sm-2" type="search" name = "input_search_categories" placeholder="Search Categories" aria-label="Search">
                <button class="btn btn-primary" type="submit" name="search_users">Filter Categories</button>
            </div>
        </form>
<?php 
$arrayCategories = array("Id", "Name", "Parent_id");

if(isset($_POST['search_categories'])) {
    $search = strtolower($_POST['input_search_categoriess']);
    $sql = "SELECT * FROM categories WHERE LOWER(CONCAT(id, name, parent_category)) LIKE '%$search%'";
    $response = $bdd->prepare($sql);
    $response->execute();
    printTable($response, $arrayCategories, "category");
}
else {
    $response = $bdd->prepare("SELECT * FROM categories");
    $response->execute();
    printTable($response, $arrayCategories, "category");
}
if (isset($_POST['delete_category'])) {
    deleteCategoryIntoDb();
}
?>

</body>
</html>