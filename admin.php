<?php
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
                                  VALUES (?, ?, ?, ?, ?;");
        $reponse->bindParam(1, $this->name, PDO::PARAM_STR);
        $reponse->bindParam(2, $this->description, PDO::PARAM_STR);
        $reponse->bindParam(3, $this->picture, PDO::PARAM_STR);
        $reponse->bindParam(4, $this->price, PDO::PARAM_INT);
        $reponse->bindParam(5, $this->category_id, PDO::PARAM_INT);
        $reponse->execute();
        #echo "Product created" . PHP_EOL;
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
                                  VALUES (?, ?;");
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

        $reponse = $bdd->prepare("INSERT INTO users(username, password, email, admin) 
                                  VALUES (?, ?, ?, ?;");
        $reponse->bindParam(1, $this->username, PDO::PARAM_STR);
        $reponse->bindParam(2, $this->password, PDO::PARAM_STR);
        $reponse->bindParam(3, $this->email, PDO::PARAM_STR);
        $reponse->bindParam(4, $this->admin, PDO::PARAM_INT);
        $reponse->execute();
        #echo "User created" . PHP_EOL;
    }
} 

$_POST['name'] = new Product($_POST['name'], $_POST['description'], $_POST['picture'], $_POST['price'], $_POST['category_id']);
$_POST['name_category'] = new Category($_POST['name_category'], $_POST['parent_id']);
$_POST['username'] = new User($_POST['username'], $_POST['password'], $_POST['email'], $_POST['admin']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="author" content="All Stars" />
    <meta name="description"
        content="All stars is a concept store of furnitures for your appartement. You will find amazing design furnitures for your living room, your kitchen, your batchroom and your bedroom." />
    <link href="style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <title>All stars - Concept Store</title>
</head>

<body>
<h1> Administration page </h1>
    <h2> Add Users </h2>   
        <form>
            <div class="form-group">
                    <label for="username">Username: </label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="username"> </br>
            </div>

            <div class="form-group">
                    <label for="password">Password: </label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="password"> </br>
            </div>

            <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="name@example.com"></br>
            </div>

            <div class="form-group">
                <label for="admin">Select 1 to give ADMIN access. Otherwise select 0 </label>
                <select class="form-control" id="admin">
                <option>0</option>
                <option>1</option>
                </select>
            </div>
        </form>
    
        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Username</th>
                <th scope="col">Password</th>
                <th scope="col">Email</th>
                <th scope="col">Admin (1)</th>
                <th scope="col">Created at</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>1</td>
                <td>Estelle</td>
                <td>hash</td>
                <td>estelle@gmail.com</td>
                <td>1</td>
                <td>12.09.2020</td>
                </tr>
            </tbody>
        </table>
</body>
</html>