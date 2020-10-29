<?php
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

function deleteCategoryIntoDb(){
    $bdd = connectToDb();
    $response = $bdd->prepare("DELETE FROM categories WHERE id='" . $_POST['id'] . "';");
    $response->execute();
    $response = $bdd->prepare("SELECT * FROM categories");
    $response->execute();
    echo "<meta http-equiv='refresh' content='0'>";
}

function editCategoryIntoDb(){
    if ($_POST['name']== "") {
        $bdd = connectToDb();
        $response = $bdd->prepare("SELECT * FROM categories;");
        $response->execute();
    }
    else {
        $bdd = connectToDb();
        $response = $bdd->prepare("SELECT name FROM categories WHERE name='" . $_POST['name'] . "';"); 
        $response->execute();
        $donnee = $response->fetch();
        if ($donnee['name'] == null) {
            $bdd = connectToDb();
            $response = $bdd->prepare("UPDATE categories 
                SET name='" . $_POST['name'] . "', 
                parent_id='" . $_POST['parent_id'] . "' WHERE id='" . $_POST['id'] . "';");
            $response->execute();
            $response = $bdd->prepare("SELECT * FROM categories");
            $response->execute();
            echo "<meta http-equiv='refresh' content='0'>";
        }
    }
}
?>