<?php
include "db_connect.php";

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $extension = array('jpeg', 'jpg', 'png');
    foreach($_FILES['image']['tmp_name'] as $key => $value) {
        
        $filename = $_FILES['image']['name'][$key];
        $tmp_filename = $_FILES['image']['tmp_name'][$key];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        
        if(in_array($ext, $extension)) {
            $filename = str_replace('.', '_', basename($filename, $ext)) ;
            $newfilename = $filename.time().".".$ext;
            $image = 'public/property/'. $newfilename;
            move_uploaded_file($tmp_filename, $image);
            $array_image[] = $image;

            // if(!file_exists('images/'.$filename)) {
            // move_uploaded_file($tmp_filename, 'images/'.$filename);
            // $image = $filename;
            // } else {
            //     $filename = str_replace('.', '_', basename($filename, $ext)) ;
            //     $newfilename = $filename.time().".".$ext;
            //     move_uploaded_file($tmp_filename, 'images/'.$newfilename);
            //     $image = $newfilename;
            // }

            // $insert_img = "INSERT INTO `property_list`(`images`) VALUES ('$image')";
            // mysqli_query($con, $insert_img);

            // header("Location : index");
        } 
    }
    
    $array_image = implode(", ", $array_image);
    $insert_img = "INSERT INTO `property_list`(`images`, `name`) VALUES ('$array_image', '$name')";
    $results = mysqli_query($con, $insert_img);

    print_r($results);
    header("Location:index.php");

}
?>