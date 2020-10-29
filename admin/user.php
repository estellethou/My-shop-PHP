<?php
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
    if (($_POST['username']) == "" || $_POST['email'] == "" || $_POST['password'] == "" || $_POST['admin'] == ""){
        $bdd = connectToDb();
        $response = $bdd->prepare("SELECT * FROM users;"); 
        $response->execute();
    }
    elseif ($_POST['admin'] != 0 && $_POST['admin'] != 1 ) {
        echo "Choose 1 to give admin access, 0 otherwise. " . PHP_EOL;
    }
    else {
        $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $bdd = connectToDb();
            $response = $bdd->prepare("UPDATE users 
                SET username='" . $_POST['username'] . "', 
                password='" . $hash . "',
                admin='" . $_POST['admin'] . "' WHERE id='" . $_POST['id'] . "';");
            $response->execute();
            echo "<meta http-equiv='refresh' content='0'>";
            $response = $bdd->prepare("SELECT email FROM users WHERE email='" . $_POST['email'] . "';"); 
            $response->execute();
            $donnee = $response->fetch();
            if ($donnee['email'] == null) {
                $response = $bdd->prepare("UPDATE users 
                    SET email='" . $_POST['email'] . "'
                    WHERE id='" . $_POST['id'] . "';");
                $response->execute();
                $response = $bdd->prepare("SELECT * FROM users");
                $response->execute();
                echo "<meta http-equiv='refresh' content='0'>";
            }
        } 
    }      
}
?>