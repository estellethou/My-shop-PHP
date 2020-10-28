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
?>