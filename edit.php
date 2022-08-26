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
    <div class="container">
        <div class="col-md-4 gap-6 m-6">
            <form action="edit_data.php" method="post" enctype="multipart/form-data">
                <div class="mb-6">
                    <label class="text-lg font-semibold">Input Image :</label>
                    <input type="file" name="image[]" class="flex" multiple> 
                    <input type="hidden" name="id" value="<?php echo $id ?>" >
                    <input type="submit" name="update" id="update" class="mt-2 p-2 bg-blue-600 rounded-lg text-white" value="Update">
                </div>
                    
                
                
            </form>
            <ul id="sortable" class="grid grid-cols-4 gap-6">
                    <?php 
                    $sql = "SELECT * FROM property_list where id_property = '".$id."' ";
                    $property = mysqli_query($con, $sql);
                        while($row = mysqli_fetch_assoc($property)){
                    $name = $row['name'];
                    $images = $row['images'];

                    foreach(explode(', ', $row['images']) as $img) {
                     ?>
                     <!-- <div class="bg-white" data-id="<?php echo $id?>">
                        <img src="<?php echo $img ?>" class="image_link " />
                        <a href="javascript:void(0);" class="bg-red-600 p-2" onclick="deleteImage('<?php echo $img ?>')">Delete</a>
                     </div> -->
                     
                     <li class="ui-state-default rounded-2xl shadow-lg bg-white relative" data-id="<?php echo $id ?>">
                   
                        <img class="image_link rounded-2xl h-56 w-full" src="<?php echo $img ?>" alt=""/>    
                        <a href="javascript:void(0);" type="button" class="px-2 py-2 bg-red-600 text-white font-medium text-xs uppercase rounded-full shadow-md hover:bg-red-700 hover:shadow-lg absolute top-0 right-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m-15 0l15 15" />
                            </svg>

                        </a>
                    </li>
                        <?php } 
                        } ?>
                
            </ul>
            <div>
                    <button type='submit' value='Submit' id='submit' class="bg-blue-600 mt-6 p-2">Submit</button>
                    <a href="index.php" type='button' id='back' class="bg-gray-500 mt-6 p-2 rounded-lg">Back</a>

                </div>
        </div>
    </div>
       
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    
    <!-- <script>
    function deleteImage(id){
        var result = confirm("Are you sure to delete?");
        if(result){
            $.post( "postAction.php", {action_type:"img_delete",id:id}, function(resp) {
                if(resp == 'ok'){
                    $('#imgb_'+id).remove();
                    alert('The image has been removed from the gallery');
                }else{
                    alert('Some problem occurred, please try again.');
                }
            });
        }
    }
    </script> -->
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