<?php
if ($_COOKIE['admin']) {
    header("Location: ../admin/admin.php");
   }
else if(isset($_COOKIE['username'])){
    header("Location: ../index/index.php");
    }

const ERROR_LOG_FILE = 'PDO_Errors.log';
const DB_HOST = "127.0.0.1";
const DB_USERNAME = "root";
const DB_PASSWORD = "root";
const DB_NAME = "my_shop";

$email= $_POST['email'];
$password = $_POST['password']; 
connect_user($email, $password);

function connect_user($email, $password) {
    try {
        $db = connect_db(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $sql = "SELECT password from users where email = '$email'";
        $query = $db->prepare($sql);
        $query->execute();
        $arrayUsers = $query->fetchAll();

        $sql2 = "SELECT username from users where email = '$email'";
        $query2 = $db->prepare($sql2);
        $query2->execute();
        $name = $query2->fetch();

        if(password_verify($password, $arrayUsers[0]["password"])) {
            setcookie("username", $name["username"], time() + 31556926, '/');
            $sql_admin = "SELECT admin from users where email = '$email'";
            $query_admin = $db->prepare($sql_admin);
            $query_admin->execute();
            $isAdmin = $query_admin->fetch();
            if($isAdmin[0] == "1") {
                setcookie("admin", true, time() + 31556926, '/');
                header('Location: ../admin/admin.php');
            }
            else {
                setcookie("admin", false, time() + 31556926, '/');
                header('Location: ../index/index.php');
            }
        }
        else if (!empty($_POST["email"])){
            ?>
            <style type="text/css">#userNotFound {
                display: block;
            }</style>
            <?php
        }
    }
    catch (Exception $e) {
        error_log("Error MySQL, user not added, more infos in \n" . ERROR_LOG_FILE, 3, ERROR_LOG_FILE);
    }
}


function connect_db($host, $usr, $pwd, $db) {
    try {
        $bdd = new PDO("mysql:host=$host;dbname=" . $db . ';charset=utf8', $usr, $pwd);
        // echo "Connection to DB successful\n";
    }
    catch (PDOException $e) {
        error_log('PDO ERROR: ' . $e->getMessage(), 3, ERROR_LOG_FILE);
        die("Error connection to DB\n");
    }
    return $bdd;
}
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <title>Sign in</title>
</head>
<body>
<?php
if (isset($_POST["submit"]) && ((empty($_POST["email"]) || empty($_POST["password"])))){
            $errEmail = "Please enter your email and password before clicking Login";
        }
        $failure = "Unable to sign in: the username/password combination you entered did not match our records.";
?>
<div class="container">
    <div class="alert alert-danger" role="alert" id="userNotFound"> <?php echo $failure; ?> 
    </div>
    <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <h2>Sign in</h2>
        <div class="form-group row">
        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" value="<?php echo $email;?>">
          <span class="error"><?php echo $errEmail; ?></span>
        </div>
        </div>
        <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
        </div>
        </div>
        <div class="form-group row">
            <input type="submit" value="Sign in" name="submit" class="btn btn-primary"/>
            <a href="signup.php"> Not a user yet ? Click here to sign up.</a>
        </div>
    </form>
</body>
</html>