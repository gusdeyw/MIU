<?php 
include "db_connect.php";
$id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Drag Drop</title>
</head>
<body>
    <div class="m-6">
        <ul id="sortable" class="grid grid-cols-4 gap-6 " >
            <?php
            $sql = "SELECT * FROM property_list where id_property = '".$id."' ";
            $property = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($property)){
                $name = $row['name'];
                $images = $row['images'];

                foreach(explode(',', $row['images']) as $img) {
            ?>

                    <li class="ui-state-default" data-id="<?php echo $id ?>">
                        <img src="<?php echo $img ?>" class="image_link hidden" />
                        <div class=" h-56 rounded-md bg-center bg-cover mx-auto" style="background-image: url('<?php echo $img ?>');"></div>
                    </li>
            <?php
                }
            }            
            ?>
        </ul>  
        <div >
            <button type='submit' value='Submit' id='submit' class="bg-gray-500 mt-6 p-2">Submit</button>
            <!-- <button id="submit" class="bg-gray-500 m-6 p-2">Submit</button> -->
        </div>    

        <p id="notif"></p>
    </div>
       
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    


    <script>
      $(document).ready(function() {
            $("#sortable").sortable();

            $("#submit").on('click', function() {
                var images_arr = [];
                $(".image_link").each(function(){
                    var image = $(this).attr("src");
                    images_arr.push(image);
                    
                });
                var id_image = 0;
                $("#sortable li").each(function(){
                    id_image = $(this).attr("data-id");
                });
                
                var allImage = images_arr.toString();
                console.log(allImage);

                $.ajax({
                    type: "POST",
                    url: "update_image.php",
                    data: {
                        image: allImage,
                        id : id_image
                    },
                    success:function(response) {
                        document.getElementById("notif").innerHTML = response;
                    },
                    error:function(){
                        alert("error");
                    }
                });
            });
        });
    </script>
</body>
</html>