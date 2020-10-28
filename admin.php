<?php
if (!$_COOKIE['admin']) {
    header("Location: index.php");
   }

class Product {
    const ERROR_LOG_FILE = "errors.log";
    public $name;
    public $description;
    public $picture;
    public $price;
    public $category_id;
    
    public function __construct($name, $description, $picture, $price, $category_id){
        $this->name = $name;
        $this->description = $description;
        $this->picture = $picture;
        $this->price = $price;
        $this->category_id = $category_id;

        try {
            $bdd = new PDO("mysql:host=127.0.0.1;dbname=my_shop", 'root', 'root');
            #echo "Connection to DB successful" . PHP_EOL;
        } 
        catch (PDOException $e) {
            echo 'PDO ERROR: ' . $e->getMessage() . " storage in " . ERROR_LOG_FILE . ". Error connection to DB" . PHP_EOL;
            file_put_contents(ERROR_LOG_FILE, $e, FILE_APPEND);
        }

        $reponse = $bdd->prepare("INSERT INTO products(name, description, picture, price, category_id) 
                                  VALUES (?, ?, ?, ?, ?);");
        $reponse->bindParam(1, $this->name, PDO::PARAM_STR);
        $reponse->bindParam(2, $this->description, PDO::PARAM_STR);
        $reponse->bindParam(3, $this->picture, PDO::PARAM_STR);
        $reponse->bindParam(4, intval($this->price), PDO::PARAM_INT);
        $reponse->bindParam(5, intval($this->category_id), PDO::PARAM_INT);
        $reponse->execute();
        #var_dump($reponse->errorInfo());
    }
} 

class Category {
    const ERROR_LOG_FILE = "errors.log";
    public $name_category;
    public $parent_id;
    
    public function __construct($name_category, $parent_id){
        $this->name_category = $name_category;
        $this->parent_id = $parent_id;

        try {
            $bdd = new PDO("mysql:host=127.0.0.1;dbname=my_shop", 'root', 'root');
            #echo "Connection to DB successful" . PHP_EOL;
        } 
        catch (PDOException $e) {
            echo 'PDO ERROR: ' . $e->getMessage() . " storage in " . ERROR_LOG_FILE . ". Error connection to DB" . PHP_EOL;
            file_put_contents(ERROR_LOG_FILE, $e, FILE_APPEND);
        }

        $reponse = $bdd->prepare("INSERT INTO categories(name, parent_id) 
                                  VALUES (?, ?);");
        $reponse->bindParam(1, $this->name_category, PDO::PARAM_STR);
        $reponse->bindParam(2, $this->parent_id, PDO::PARAM_INT);
        $reponse->execute();
        #echo "Category created" . PHP_EOL;
    }
} 

class User {
    const ERROR_LOG_FILE = "errors.log";
    public $username;
    public $password;
    public $email;
    public $admin;
    
    public function __construct($username, $password, $email, $admin){
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->admin = $admin;

        try {
            $bdd = new PDO("mysql:host=127.0.0.1;dbname=my_shop", 'root', 'root');
            #echo "Connection to DB successful" . PHP_EOL;
        } 
        catch (PDOException $e) {
            echo 'PDO ERROR: ' . $e->getMessage() . " storage in " . ERROR_LOG_FILE . ". Error connection to DB" . PHP_EOL;
            file_put_contents(ERROR_LOG_FILE, $e, FILE_APPEND);
        }

        $reponse = $bdd->prepare("INSERT INTO users(username, password, email, admin, created_at) 
                                  VALUES (?, ?, ?, ?, NOW());");
        $reponse->bindParam(1, $this->username, PDO::PARAM_STR);
        $reponse->bindParam(2, $this->password, PDO::PARAM_STR);
        $reponse->bindParam(3, $this->email, PDO::PARAM_STR);
        $reponse->bindParam(4, $this->admin, PDO::PARAM_INT);
        $reponse->execute();
        
        #echo "User created" . PHP_EOL;
    }
} 

try {
    $bdd = new PDO("mysql:host=127.0.0.1;dbname=my_shop", 'root', 'root');
    #echo "Connection to DB successful" . PHP_EOL;
} 
catch (PDOException $e) {
    echo 'PDO ERROR: ' . $e->getMessage() . " storage in " . ERROR_LOG_FILE . ". Error connection to DB" . PHP_EOL;
    file_put_contents(ERROR_LOG_FILE, $e, FILE_APPEND);
}

if (isset($_POST['add_user']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['admin'])){
    new User($_POST['username'], $_POST['password'], $_POST['email'], $_POST['admin']);    
}

if (isset($_POST['add_product']) && isset($_POST['name']) && isset($_POST['description']) && isset($_POST['picture']) && isset($_POST['price']) && isset($_POST['category_id'])) {
    new Product($_POST['name'], $_POST['description'], $_POST['picture'], $_POST['price'], $_POST['category_id']);
}

if (isset($_POST['add_category']) && isset($_POST['name_category']) && isset($_POST['parent_id'])) {
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

<?php 
    $reponse = $bdd->prepare("SELECT * FROM users");
    $reponse->execute();

<th scope='col'>Id</th>
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

<?php 
$reponse = $bdd->prepare("SELECT * FROM products");
$reponse->execute();

echo "<table class='table table-striped'>
<tr>
<thead class='thead-dark'>
<th scope='col'>Id</th>
<th scope='col'>Name</th>
<th scope='col'>Description</th>
<th scope='col'>Picture</th>
<th scope='col'>Price</th>
<th scope='col'>Category Id</th>
</thead>
</tr>";
echo "<tbody>";
while($donnees = $reponse->fetch())
{
echo "<tr>";
echo "<td>" . $donnees['id'] . "</td>";
echo "<td>" . $donnees['name'] . "</td>";
echo "<td>" . $donnees['description'] . "</td>";
echo "<td>" . $donnees['picture'] . "</td>";
echo "<td>" . $donnees['price'] . "</td>";
echo "<td>" . $donnees['category_id'] . "</td>";
echo "</tr>";
}
echo "</tbody>";
echo "</table>";
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

<?php 
$reponse = $bdd->prepare("SELECT * FROM categories");
$reponse->execute();

echo "<table class='table table-striped'>
<thead class='thead-dark'>
<tr>
<th scope='col'>Id</th>
<th scope='col'>Name</th>
<th scope='col'>Parent Id </th>
</tr>";
echo "</thead>";
while($donnees = $reponse->fetch())
{
echo "<tr>";
echo "<td>" . $donnees['id'] . "</td>";
echo "<td>" . $donnees['name'] . "</td>";
echo "<td>" . $donnees['parent_id'] . "</td>";
echo "</tr>";
}
echo "</table>";
?>

</body>
</html>