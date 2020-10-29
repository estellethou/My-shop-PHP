<?php
function upload_image($image) {

    if (!file_exists("../images/")){
        mkdir("../images");
    }
    $target_dir = "../images/";
    $target_file = $target_dir . basename($image["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($image["tmp_name"]);
        if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
        } else {
          echo "File is not an image.";
          $uploadOk = 0;
        }
      }
      
      // Check if file already exists
      if (file_exists($target_file)) {
        $uploadResult =  "Product was added successfully. Image was not uploaded as it already exists.";
        $uploadOk = 0;
      }
      
      // Check file size
      if ($_FILES["picture"]["size"] > 500000) {
        $uploadResult = "Sorry, your file is too large.";
        $uploadOk = 0;
      }
      
      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) {
        $uploadResult = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
      }
      
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
      // if everything is ok, try to upload file
      } else {
        if (move_uploaded_file($image["tmp_name"], $target_file)) {
            $uploadResult = "Product was created successfully.";
        } else {
        }
      }
      return $uploadResult;
}

?>