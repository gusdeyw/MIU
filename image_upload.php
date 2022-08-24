<?php
include "db_connect.php";

function compressImage($source, $destination, $quality) { 
    // Get image info 
    $imgInfo = getimagesize($source); 
    $mime = $imgInfo['mime']; 
     
    // Create a new image from file 
    switch($mime){ 
        case 'image/jpeg': 
            $image = imagecreatefromjpeg($source); 
            break; 
        case 'image/png': 
            $image = imagecreatefrompng($source); 
            break; 
        case 'image/gif': 
            $image = imagecreatefromgif($source); 
            break; 
        default: 
            $image = imagecreatefromjpeg($source); 
    } 
     
    // Save image 
    imagejpeg($image, $destination, $quality); 
     
    // Return compressed image 
    return $destination; 
}

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $extension = array('jpeg', 'jpg', 'png');
    foreach($_FILES['image']['tmp_name'] as $key => $value) {
        
        $filename = $_FILES['image']['name'][$key];
        $tmp_filename = $_FILES['image']['tmp_name'][$key];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        
        if(in_array($ext, $extension)) {
            // $filename = str_replace('.', '_', basename($filename, $ext)) ;
            // $newfilename = $filename.time().".".$ext;
            $path = 'public/property/'.$name;
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            // $image = 'public/property/'.$name.'/'.$newfilename;
            // move_uploaded_file($tmp_filename, $image);
            // $array_image[] = $image;

            if(!file_exists('public/property/'.$name.'/'.$filename)) {
            $image = 'public/property/'.$name.'/'.$filename;
            $compressedImage = compressImage($tmp_filename, $image, 20);
            
            $array_image[] = $image;

            } else {
                $filename = str_replace('.', '_', basename($filename, $ext)) ;
                $newfilename = $filename.time().".".$ext;
                $image = 'public/property/'.$name.'/'.$newfilename;
                $compressedImage = compressImage($tmp_filename, $image, 20);
                $array_image[] = $image;
            }

        } 
    }
    
    $array_image = implode(", ", $array_image);
    $insert_img = "INSERT INTO `property_list`(`images`, `name`) VALUES ('$array_image', '$name')";
    mysqli_query($con, $insert_img);
    header("Location:index.php");

}
?>