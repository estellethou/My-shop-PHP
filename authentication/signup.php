<?php
    const ERROR_LOG_FILE = 'PDO_Errors.log';
    const DB_HOST = "127.0.0.1";
    const DB_USERNAME = "root";
    const DB_PASSWORD = "root";
    #const DB_PORT = "3306";
    const DB_NAME = "my_shop";

    $email= $_POST['email'];
    $username= $_POST['username'];
    $password = $_POST['password']; 
    $hash = password_hash($password, PASSWORD_BCRYPT);

    function add_user ($email, $username, $hash) {
        try {
            $db = connect_db(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            $sql = "SELECT email from users where email = '$email'";
            $query = $db->prepare($sql);
            $query->execute();
            $arrayUsers = $query->fetchAll();
            if ($arrayUsers == null){
                $sql = "INSERT INTO users (username, password, email, admin, created_at) VALUES ('$username', '$hash', '$email', 0, CURRENT_TIMESTAMP)";
                $query = $db->prepare($sql);
                $query->execute();
                $arrayUsers = $query->fetchAll();
                return true;
            }
            else {
                return false;
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
    if(isset($_POST['submit'])) {
      // Check if name has been entered
      if(empty($_POST['username'])) {
        $errName= 'Please enter your username';
      }
      else if ((strlen($_POST['username'])) < 4) {
        $errName= 'Your username should be at least 4 characters long';
      }
      // Check if email has been entered and is valid
      else if(empty($_POST['email'])) {
        $errEmail = 'Please enter a valid email address';
      }
      // check if a password has been entered and if it is a valid password
      else if(empty($_POST['password']) || strlen($_POST['password']) < 4) {
        $errPass = '<p class="errText">Password must be at least 4 characters</p>';
      } 
      else if ($_POST["password"] != $_POST["passwordConf"])  { 
            $pwdConfErr = "Password and confirmation did not match";
      } 
      else {
        $successMessage = "The form has been submitted";
        if(add_user($email, $username, $hash)) {
            header("refresh:5; url=signin.php" );
            $success = "User successfully created";
            ?>
            <style type="text/css">#userCreated {
                display: block;
            }</style>
            <?php
        }
        else {
          $errEmail = "This email is already registered. Try logging in or use a different email address";
        }
      }
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
  <title>Sign up</title>
</head>
<body>
  <div class="container">
    <span class="alert alert-success" role="alert" id="userCreated"> <?php echo $success; ?> </span>
    <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <h2>Sign up</h2>
      <div class="form-group row">
        <label for="inputUser" class="col-sm-2 col-form-label">Username</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputUser" name="username" placeholder="Enter a username" value="<?php echo $username;?>">
          <span class="error"><?php echo $errName; ?></span>
        </div>
      </div>
      <div class="form-group row">
        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Enter your email" value="<?php echo $email;?>">
          <span class="error"><?php echo $errEmail; ?></span>
        </div>
      </div>
      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Choose a password">
          <span class="error"><?php echo $errPass; ?></span>
        </div>
      </div>
      <div class="form-group row">
        <label for="inputPassword4" class="col-sm-2 col-form-label">Password confirmation</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="inputPassword" name="passwordConf" placeholder="Confirm your password">
          <span class="error"><?php echo $pwdConfErr; ?></span>
        </div>
      </div>
      <div class="form-group row">
          <input type="submit" value="Sign up" name="submit" class="btn btn-primary"/> 
          <a href="signin.php"> Already signed up ? Click here to sign in.</a>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>